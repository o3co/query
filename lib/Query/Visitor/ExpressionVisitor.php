<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Term;

/**
 * ExpressionVisitor 
 * 
 * @uses Visitor
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class ExpressionVisitor implements Visitor 
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
     * @param Term $expr 
     * @access public
     * @return void
     */
    public function visit(Term $expr)
    {
        return $expr->dispatch($this);
    }

    /**
     * visitStatement 
     * 
     * @param Term\Statement $statement 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitStatement(Term\Statement $statement);

    /**
     * visitLogicalExpression 
     * 
     * @param Term\LogicalExpression $expr 
     * @abstract
     * @access public
     * @return void
     */
    abstract function visitLogicalExpression(Term\LogicalExpression $expr);
}
