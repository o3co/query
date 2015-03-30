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
class ConditionalClause extends AbstractClause 
{
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
            throw new \RuntimeException('ConditionalClause only accept ConditionalExpression for its part');
        }

        return parent::add($part);
    }

    /**
     * getFirstExpression 
     * 
     * @access public
     * @return void
     */
    public function getFirstExpression()
    {
        return $this->getParts()[0];
    }

    /**
     * getExpresions 
     * 
     * @access public
     * @return void
     */
    public function getExpressions()
    {
        return $this->getParts();
    }

    public function setExpressions(array $exprs)
    {
        $this->setParts($exprs);
    }
}
