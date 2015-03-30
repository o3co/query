<?php
namespace O3Co\Query\Query\Term;
use O3Co\Query\Query\Term;

/**
 * CompositeExpression 
 *   
 * @uses Expression
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class CompositeExpression extends AbstractTerm implements Expression
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
     * getFirstTerm 
     * 
     * @access public
     * @return void
     */
    public function getFirstTerm()
    {
        return reset($this->terms);
    }
    
    /**
     * getTerms 
     * 
     * @access public
     * @return void
     */
    public function getTerms()
    {
        return $this->terms;
    }
    
    /**
     * setTerms 
     * 
     * @param array $terms 
     * @access public
     * @return void
     */
    public function setTerms(array $terms)
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
        return $this->getTerms();
    }

    public function setExpressions(array $exprs)
    {
        $this->setTerms($exprs);
    }
}

