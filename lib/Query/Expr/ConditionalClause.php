<?php
namespace O3Co\Query\Query\Expr;

use O3Co\Query\Query\Expr;
use O3Co\Query\Query\Expr\ConditionalExpression;

/**
 * ConditionalClause 
 *   ConditionalClause bind all internal parts with AND op
 * @uses AbstractClause
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class ConditionalClause extends AbstractPart implements Clause 
{
    private $expression;

    /**
     * __construct 
     * 
     * @param Expr\Part $part 
     * @access public
     * @return void
     */
    public function __construct(Expr\Part $part = null)
    {
        if($part && !($part instanceof ConditionalExpression)) {
            throw new \RuntimeException(sprintf('ConditionalClause only accept ConditionalExpression, but "%s" is given', is_object($part) ? get_class($part) : gettype($part)));
        }
        $this->expression = $part;
    }

    /**
     * add 
     * 
     * @param Part $part 
     * @access public
     * @return void
     */
    public function add(Expr\Part $part)
    {
        if(!$part instanceof ConditionalExpression) {
            throw new \RuntimeException(sprintf('ConditionalClause only accept ConditionalExpression, but "%s" is given', is_object($part) ? get_class($part) : gettype($part)));
        }

        if(!$this->expression) {
            $this->expression = $part;
        } else if(($this->expression instanceof LogicalExpression) && $this->expression->isType(LogicalExpression::TYPE_AND)) {
            // if root expression is AND logicalExpression, then append
            $this->expression->add($part);
        } else {
            // create new AND logicalExpression and append both current expression and new expresion
            $and = new Expr\LogicalExpression(array(
                    $this->expression,
                    $part
                ), Expr\LogicalExpression::TYPE_AND);

            $this->expression = $and;
        }
        return $this;
    }

    /**
     * getExpresion
     * 
     * @access public
     * @return Expr\Expression 
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * setExpression 
     * 
     * @param Expr\ConditionalExpression $expr 
     * @access public
     * @return void
     */
    public function setExpression(Expr\ConditionalExpression $expr)
    {
        $this->expression = $expr;
    }
}
