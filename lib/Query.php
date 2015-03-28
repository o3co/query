<?php
namespace O3Co\Query;

use O3Co\Query\Query\Term\Statement;

/**
 * Query 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Query 
{
    /**
     * persister 
     * 
     * @var mixed
     * @access private
     */
    private $persister;

    /**
     * statement 
     * 
     * @var mixed
     * @access private
     */
    private $statement;

    /**
     * __construct 
     * 
     * @param Statement $statement 
     * @param Persister $persister 
     * @access public
     * @return void
     */
    public function __construct(Statement $statement, Persister $persister = null)
    {
        $this->statement = $statement;
        $this->persister = $persister;
    }
    
    /**
     * getPersister 
     * 
     * @access public
     * @return Persister 
     */
    public function getPersister()
    {
        return $this->persister;
    }
    
    /**
     * setPersister 
     * 
     * @param Persister $persister 
     * @access public
     * @return void
     */
    public function setPersister(Persister $persister)
    {
        $this->persister = $persister;
        return $this;
    }
    
    /**
     * getStatement 
     * 
     * @access public
     * @return void
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * getNativeQuery 
     * 
     * @access public
     * @return void
     */
    public function getNativeQuery(array $options = array())
    {
        if(!$this->persister) {
            throw new \RuntimeException('Persister is not specified.');
        }
        return $this->persister->getNativeQuery($this, $options);
    }
    
    /**
     * execute 
     * 
     * @access public
     * @return void
     */
    public function execute()
    {
        if(!$this->persister) {
            throw new \RuntimeException('Persister is not specified.');
        }
        return $this->persister->execute($this);
    }
}
