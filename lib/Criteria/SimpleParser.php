<?php
namespace O3Co\Query\Criteria;

use O3Co\Query\CriteriaParser;
use O3Co\Query\Persister;
use O3Co\Query\Fql\Parser as FqlParser;
use O3Co\Query\Query;
use O3Co\Query\Query\ExpressionBuilder;
use O3Co\Query\Query\Term;

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
	public function parse(array $criteria, array $order = array())
	{
		$fieldExprs = array();
		foreach($criteria as $field => $value) {
			if(is_array($value)) {
				$fieldExprs[] = $this->parseOrXValues($field, $value);
			} else {
				$fieldExprs[] = $this->parseFieldValue($field, $value);
			}
		}
		// Join all field expressions by AND
        if(1 < count($fieldExprs)) {
		    $condition = $this->expr()->andX($fieldExprs);
        } else {
            $condition = array_shift($fieldExprs);
        }

		$statement = new Term\Statement();
		$statement->setClause('condition', new Term\ConditionalClause(array($condition)));
		//$statement->setClause('order', new Term\OrderClause($condition));

		return new Query($statement, $this->persister);
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
			return $fqlParser->parseFql($field, $value);
		} else {
			return $this->expr()->eq($field, $value);
		}
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
    
    public function getPersister()
    {
        return $this->persister;
    }
    
    public function setPersister(Persister $persister)
    {
        $this->persister = $persister;
        return $this;
    }
}

