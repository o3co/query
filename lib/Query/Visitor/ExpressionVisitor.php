<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Part;

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
     * @param Part\Statement $statement 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitStatement(Part\Statement $statement);

    /**
     * visitLogicalExpression 
     * 
     * @param Part\LogicalExpression $expr 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitLogicalExpression(Part\LogicalExpression $expr);
}
