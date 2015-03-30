<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Expr;

/**
 * ExpressionVisitor 
 * 
 * @uses Visitor
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class ExpressionVisitor implements OuterVisitor 
{
    /**
     * reset 
     * 
     * @access public
     * @return void
     */
    public function reset()
    {
    }

    /**
     * visit 
     * 
     * @param Part $expr 
     * @access public
     * @return void
     */
    public function visit(Part $expr)
    {
        return $expr->dispatch($this);
    }

    /**
     * visitStatement 
     * 
     * @param Expr\Statement $statement 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitStatement(Expr\Statement $statement);

    /**
     * visitLogicalExpression 
     * 
     * @param Expr\LogicalExpression $expr 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitLogicalExpression(Expr\LogicalExpression $expr);
}
