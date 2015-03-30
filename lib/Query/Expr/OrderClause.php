<?php
namespace O3Co\Query\Query\Part;

use O3Co\Query\Query\Expr;

/**
 * OrderClause 
 * 
 * @uses AbstractClause
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class OrderClause extends AbstractPart implements Clause, MultiExpressionPart
{
    private $expressions = array();
    
    /**
     * __construct 
     * 
     * @param array<Expression> $exprs 
     * @access public
     * @return void
     */
    public function __construct(array $exprs = array())
    {
        $this->expressions = array();
        foreach($exprs as $expr) {
            $this->addExpression($expr);
        }
    }

    /**
     * getExpressions 
     * 
     * @access public
     * @return array<OrderExpression> 
     */
    public function getExpressions()
    {
        return $this->expressions;
    }

    /**
     * addExpression 
     * 
     * @param Expression $expr 
     * @access public
     * @return void
     */
    public function addExpression(Expression $expr)
    {
        if(!$expr instanceof OrderExpression) {
            throw new \InvalidArgumentException('OrderClause only accept OrderExpression as its term.');
        }

        // internal Expression has to be an unique by field 
        $this->expressions[$expr->getField()->getName()] = $expr;

        return $this;
    }
}

