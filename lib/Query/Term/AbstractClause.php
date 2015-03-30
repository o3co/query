<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * AbstractClause 
 * 
 * @uses Clause
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractClause extends AbstractTerm implements Clause, MultiExpressionPart
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
     * add 
     * 
     * @param Term $term 
     * @access public
     * @return void
     */
    public function add(Term $term)
    {
        $this->terms[] = $term;
    }

    public function getExpressions()
    {
        return $this->getTerms();
    }

    public function addExpression(Expression $expr)
    {
        $this->add($expr);
    }
}

