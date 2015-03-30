<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * Statement
 * 
 * @uses Term
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Statement extends AbstractTerm
{
    /**
     * clauses 
     * 
     * @var array
     * @access private
     */
    private $clauses = array();

    /**
     * hasClause 
     * 
     * @param mixed $clause 
     * @access public
     * @return void
     */
    public function hasClause($clause)
    {
        return isset($this->clauses[$clause]);
    }

    /**
     * getClause 
     * 
     * @param mixed $clause 
     * @access public
     * @return void
     */
    public function getClause($clause)
    {
        if(!isset($this->clauses[$clause])) {
            throw new \RuntimeException(sprintf('Clause "%s" is not declared in Statement.', $clause));
        }
        return $this->clauses[$clause];
    }

    /**
     * addClause 
     * 
     * @param Clause $clause 
     * @access public
     * @return void
     */
    public function addClause(Clause $clause)
    {
        $classname = array_pop(explode('\\', get_class($clause)));
        $this->clauses[$classname] = $clause;

        return $this;
    }

    /**
     * setClause 
     * 
     * @param mixed $alias 
     * @param Clause $clause 
     * @access public
     * @return void
     */
    public function setClause($alias, Clause $clause)
    {
        $this->clauses[$alias] = $clause;

        return $this;
    }
    
    /**
     * getClauses 
     * 
     * @access public
     * @return void
     */
    public function getClauses()
    {
        return $this->clauses;
    }
    
    /**
     * setClauses 
     * 
     * @param mixed $clauses 
     * @access public
     * @return void
     */
    public function setClauses($clauses)
    {
        $this->clauses = array();

        foreach($clauses as $name => $clause) {
            $this->setClause($name, $clause);
        }
        return $this;
    }
}

