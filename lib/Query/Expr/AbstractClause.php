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
     * parts 
     * 
     * @var mixed
     * @access private
     */
    private $parts;

    /**
     * __construct 
     * 
     * @param array $parts 
     * @access public
     * @return void
     */
    public function __construct(array $parts = array()) 
    {
        $this->parts = array();
        foreach($parts as $part) {
            $this->add($part);
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
        return $this->parts;
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
        $this->parts[] = $part;
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

