<?php
namespace O3Co\Query\Criteria;

use O3Co\Query\CriteriaParser;
use O3Co\Query\Persister;
use O3Co\Query\Fql\Parser as FqlParser;
use O3Co\Query\Query;
use O3Co\Query\Query\ExpressionBuilder;
use O3Co\Query\Query\Term;

use O3Co\Query\Exception\ParserException;

/**
 * SimpleParser 
 *    SimpleParser is a Default CriteriaParser to provide default simple expression.
 *    This parse string as fql if needed, and use eq operator for other.
 * @uses CriteriaParser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleParser implements CriteriaParser
{
    /**
     * fqlParser 
     *   FqlParser to parse field value 
     * @var mixed
     * @access private
     */
	private $fqlParser;

    /**
     * exprBuilder 
     *   ExpressionBuilder 
     * @var mixed
     * @access private
     */
	private $exprBuilder;

    /**
     * persister 
     * 
     * @var mixed
     * @access private
     */
    private $persister;
    /**
     * __construct 
     * 
     * @param FqlParser $fqlParser 
     * @param ExpressionBuilder $exprBuilder 
     * @access public
     * @return void
     */
	public function __construct(FqlParser $fqlParser = null, Persister $persister = null, ExpressionBuilder $exprBuilder = null)
	{
		if(!$exprBuilder) {
			// use ExpressionBuilder 
			$exprBuilder = new ExpressionBuilder();
		}
		$this->exprBuilder = $exprBuilder;

        $this->fqlParser = $fqlParser;
        $this->persister = $persister;
	}

    /**
     * parse 
     *   Parse fields criteria and order
     * @param array $criteria 
     * @param array $order 
     * @access public
     * @return void
     */
	public function parse(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$statement = new Term\Statement();

        if(!empty($criteria)) {
    		$statement->setClause('condition', $this->parseCriteria($criteria));
        }

        if(!empty($orderBy)) 
            $statement->setClause('order', $this->parseOrderBy($orderBy));
        if($limit)
            $statement->setClause('limit', $this->parseLimit($limit));
        if($offset)
            $statement->setClause('offset', $this->parseOffset($offset));

        return new Query($statement, $this->persister);
    }

    public function parseCriteria(array $criteria)
    {
		$condExprs = array();
		foreach($criteria as $field => $value) {
		    if(is_array($value)) {
		    	$condExprs[] = $this->parseOrXValues($field, $value);
		    } else {
		    	$condExprs[] = $this->parseFieldValue($field, $value);
		    }
		}

		// Join all field expressions by AND
        $condition = null;
        if(1 < count($condExprs)) {
		    $condition = $this->expr()->andX($condExprs);
        } else if(1 == count($condExprs)) {
            $condition = array_shift($condExprs);
        } 

    	return new Term\ConditionalClause(array($condition));
	}

    public function parseOrderBy($orders)
    {
        if(is_string($orders) && $this->fqlParser) {
            // specified with fql syntax 
            return $this->fqlParser->parseOrderClause($this->fqlParser->createLexer($orders));
        } else if(is_array($orders)) {
            // field vs sorting type array.
            $exprs = array(); 
            foreach($orders as $field => $sort) {
                $exprs[] = new Term\OrderExpression($field, $this->convertToSortingType($sort));
            }
            return new Term\OrderClause($exprs);
        }

        throw new \InvalidArgumentException('Order criteria is invalid format.');
    }

    public function parseLimit($limit)
    {
        return new Term\LimitClause(new Term\ValueIdentifier($limit));
    }

    public function parseOffset($offset)
    {
        return new Term\OffsetClause(new Term\ValueIdentifier($offset));
    }

    /**
     * parseOrXValues 
     *   parse deep array as a orx
     * @param mixed $field 
     * @param mixed $values 
     * @access protected
     * @return void
     */
	protected function parseOrXValues($field, $values)
	{
		$exprs = array();
		foreach($values as $value) {
			$exprs[] = $this->parseFieldValue($field, $value);
		}

		return $this->expr()->orX($exprs);
	}

	protected function parseAndXValues($field, $values)
	{
		$exprs = array();
		foreach($values as $value) {
			$exprs[] = $this->parseFieldValue($field, $value);
		}

		return $this->expr()->andX($exprs);
	}

	protected function parseFieldValue($field, $value)
	{
		if(is_array($value)) {
			$exprs = array();
			foreach($values as $value) {
				if(is_array($value)) {
					throw new \InvalidArgumentException(sprintf('CriteriaParser only support 1 depth of array for field "%s"', $field));
				} else {
					$exprs[] = $this->doParseFieldString($field, $value);
				}
			}
			
			// Join internal expressions by "AND"
			return $this->expr()->andX($exprs);
		} else if(is_string($value)) {
			return $this->doParseFieldString($field, $value);
		} else {
			return $this->expr()->eq($field, $value);
		}
	}

	protected function doParseFieldString($field, $value)
	{
		// 
		$fqlParser = $this->getFqlParser();
		if($fqlParser) {
			// Convert fqlQuery to Query\Part
            try {
			    return $fqlParser->parseFql($field, $value);
            } catch(ParserException $ex) {
                // Failed on parse, thus use the value as string value
            }
		}
		return $this->expr()->eq($field, $value);
	}

    public function getFqlParser()
    {
        return $this->fqlParser;
    }
    
    public function setFqlParser(FqlParser $fqlParser = null)
    {
        $this->fqlParser = $fqlParser;
        return $this;
    }

	/**
	 * expr 
	 *   Get ExpressionBuidler 
	 * @access public
	 * @return void
	 */
	public function expr()
	{
		return $this->exprBuilder;
	}
    
    /**
     * getPersister 
     * 
     * @access public
     * @return void
     */
    public function getPersister()
    {
        return $this->persister;
    }
    
    /**
     * setPersister 
     * 
     * @param Persister $persister 
     * @access public
     * @return void
     */
    public function setPersister(Persister $persister)
    {
        $this->persister = $persister;
        return $this;
    }

    protected function convertToSortingType($sort)
    {
        if(is_string($sort)) {
            switch(strtolower($sort)) {
            case 'asc':
                return Term\OrderExpression::ORDER_ASCENDING;
            case 'desc':
            default:
                return Term\OrderExpression::ORDER_DESCENDING;
            }
        }
    }
}

