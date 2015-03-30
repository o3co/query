<?php
namespace O3Co\Query\Query;

use O3Co\Query\Query;
use O3Co\Query\QueryBuilder;
use O3Co\Query\Persister;
use O3Co\Query\Query\ExpressionBuilder;
use O3Co\Query\Query\Expr;


/**
 * SimpleQueryBuilder 
 * 
 * @uses QueryBuilder
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class SimpleQueryBuilder implements QueryBuilder 
{
    /**
     * expressionBuilder 
     * 
     * @var mixed
     * @access private
     */
    private $expressionBuilder;

    /**
     * statement 
     * 
     * @var mixed
     * @access private
     */
    private $statement;

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
     * @param Persister $persister 
     * @param ExpressionBuilder $exprBuilder 
     * @param Expr\Statement $statement 
     * @access public
     * @return void
     */
    public function __construct(Persister $persister = null, ExpressionBuilder $exprBuilder = null, Expr\Statement $statement = null)
    {
        $this->persister = $persister;

        if(!$exprBuilder)
            $exprBuilder = new ExpressionBuilder();
        $this->expressionBuilder = $exprBuilder;

        if(!$statement) 
            $statement = new Expr\Statement();
        $this->statement = $statement;
    }

    /**
     * expr 
     * 
     * @access public
     * @return void
     */
    public function expr()
    {
        return $this->getExpressionBuilder();
    }

    /**
     * add 
     * 
     * @param mixed $part 
     * @param mixed $clause 
     * @access public
     * @return void
     */
    public function add($part, $clause = null)
    {
        if(!$clause) {
            throw new \InvalidArgumentException('Clause has to be specified to add.');
        }

        if(!$this->getStatement()->hasClause($clause)) {
            switch($clause) {
            case 'condition':
                $this->getStatement()->setClause($clause, new Part\ConditionalClause());
                break;
            case 'order':
                $this->getStatement()->setClause($clause, new Part\OrderClause());
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Clasue "%s" is unknown type of Clause. Please init clause with setClause first.', $clause));
                break;
            }
        }
            
        $clause = $this->getStatement()->getClause($clause);
        if(!$clause instanceof Part\MultiExpressionPart) {
            throw new \RuntimeException('QueryBuilder::add only support a Clause as a MultiExpressionPart.');
        }

        $clause->addExpression($part);
        return $this;
    }

    public function addWhere($expr)
    {
        return $this->add($expr, 'condition');
    }
    

    public function addOrder($expr)
    {
        return $this->add($expr, 'order');
    }

    /**
     * setMaxResults 
     * 
     * @param mixed $limit 
     * @access public
     * @return void
     */
    public function setMaxResults($limit)
    {
        $limit = (int)$limit;

        if(0 === $limit) {
            $this->getStatement()->removeClause('limit');
        } else {
            // 
            $this->getStatement()->setClause('limit', new Part\LimitClause($limit));
        }

        return $this;
    }

    /**
     * setFirstResult 
     * 
     * @param mixed $offset 
     * @access public
     * @return void
     */
    public function setFirstResult($offset)
    {
        $this->getStatement()->setClause('offset', new Part\OffsetClause($offset));

        return $this;
    }
    /**
     * getExpressionBuilder 
     * 
     * @access public
     * @return void
     */
    public function getExpressionBuilder()
    {
        return $this->expressionBuilder;
    }
    
    /**
     * setExpressionBuilder 
     * 
     * @param ExpressionBuilder $expressionBuilder 
     * @access public
     * @return void
     */
    public function setExpressionBuilder(ExpressionBuilder $expressionBuilder)
    {
        $this->expressionBuilder = $expressionBuilder;
        return $this;
    }
    
    /**
     * getStatement 
     * 
     * @access public
     * @return void
     */
    public function getStatement()
    {
        return $this->statement;
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

    /**
     * getQuery 
     * 
     * @access public
     * @return void
     */
    public function getQuery()
    {
        return new Query($this->statement, $this->persister);
    }
}

