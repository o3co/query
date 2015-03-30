<?php
namespace O3Co\Query\Query\Part;

use O3Co\Query\Query\Expr;
use O3Co\Query\Query\Expr\ConditionalExpression;

/**
 * ConditionalClause 
 *   ConditionalClause bind all internal terms with AND op
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
     * @param Part $term 
     * @access public
     * @return void
     */
    public function add(Part $term)
    {
        if(!$term instanceof ConditionalExpression) {
            throw new \RuntimeException('ConditionalClause only accept ConditionalExpression for its term');
        }

        return parent::add($term);
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
