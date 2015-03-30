<?php
namespace O3Co\Query\Query\Expr;

use O3Co\Query\Query\Expr;

/**
 * AbstractClause 
 * 
 * @uses Clause
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractClause extends AbstractPart implements Clause, MultiExpressionPart
{
    /**
     * terms 
     * 
     * @var mixed
     * @access private
     */
    private $terms;

    /**
     * __construct 
     * 
     * @param array $terms 
     * @access public
     * @return void
     */
    public function __construct(array $terms = array()) 
    {
        $this->terms = array();
        foreach($terms as $term) {
            $this->add($term);
        }
    }

    /**
     * getParts 
     * 
     * @access public
     * @return void
     */
    public function getParts()
    {
        return $this->terms;
    }

    /**
     * add 
     * 
     * @param Part $term 
     * @access public
     * @return void
     */
    public function add(Expr\Part $term)
    {
        $this->terms[] = $term;
    }

    public function getExpressions()
    {
        return $this->getParts();
    }

    public function addExpression(Expression $expr)
    {
        $this->add($expr);
    }
}

