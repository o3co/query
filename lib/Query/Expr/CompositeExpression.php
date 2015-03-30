<?php
namespace O3Co\Query\Query\Expr;
use O3Co\Query\Query\Expr;

/**
 * CompositeExpression 
 *   
 * @uses Expression
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class CompositeExpression extends AbstractPart implements Expression
{
    /**
     * parts 
     * 
     * @var mixed
     * @access private
     */
    private $parts;

    public function __construct(array $parts = array())
    {
        foreach($parts as $part) {
            $this->add($part);
        }
    }

    /**
     * getFirstPart 
     * 
     * @access public
     * @return void
     */
    public function getFirstPart()
    {
        return reset($this->parts);
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
     * setParts 
     * 
     * @param array $parts 
     * @access public
     * @return void
     */
    public function setParts(array $parts)
    {
        $this->parts = array();

        foreach($parts as $part) {
            $this->add($part);
        }
        return $this;
    }

    /**
     * add 
     * 
     * @param Expression $part 
     * @access public
     * @return void
     */
    public function add(Expression $part)
    {
        $this->parts[] = $part;
        return $this;
    }

    public function getExpressions()
    {
        return $this->getParts();
    }

    public function setExpressions(array $exprs)
    {
        $this->setParts($exprs);
    }
}

