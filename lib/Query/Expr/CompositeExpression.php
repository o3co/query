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
     * terms 
     * 
     * @var mixed
     * @access private
     */
    private $terms;

    public function __construct(array $terms = array())
    {
        foreach($terms as $term) {
            $this->add($term);
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
        return reset($this->terms);
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
     * setParts 
     * 
     * @param array $terms 
     * @access public
     * @return void
     */
    public function setParts(array $terms)
    {
        $this->terms = array();

        foreach($terms as $term) {
            $this->add($term);
        }
        return $this;
    }

    /**
     * add 
     * 
     * @param Expression $term 
     * @access public
     * @return void
     */
    public function add(Expression $term)
    {
        $this->terms[] = $term;
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

