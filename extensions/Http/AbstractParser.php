<?php
namespace O3Co\Query\Extension\Http;

use O3Co\Query\Parser as ParserInterface;
use O3Co\Query\Query;
use O3Co\Query\Query\Term\Statement;
use O3Co\Query\Persister;

/**
 * AbstractParser 
 *   Abstract Parser for Http Based Query 
 * @uses ParserInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractParser implements ParserInterface 
{
    const DEFAULT_QUERY_KEY   = 'q';
    const DEFAULT_SORT_KEY    = 'order';
    const DEFAULT_SIZE_KEY    = 'size';
    const DEFAULT_OFFSET_KEY  = 'offset';

    /**
     * queryComponentKeys 
     * 
     * @var mixed
     * @access private
     */
    private $queryComponentKeys;

    /**
     * persister 
     * 
     * @var Persister 
     * @access private
     */
    private $persister;

    /**
     * __construct 
     * 
     * @param array $keys 
     * @access public
     * @return void
     */
    public function __construct(array $keys = array(), Persister $persister = null)
    {
        if(empty($keys)) {
            $keys = array(
                    self::DEFAULT_QUERY_KEY => 'condition', 
                    self::DEFAULT_SORT_KEY => 'order', 
                    self::DEFAULT_SIZE_KEY => 'size', 
                    self::DEFAULT_OFFSET_KEY => 'offset'
                );
        }
        $this->queryComponentKeys = $keys; 

        $this->persister = $persister;
    }

    /**
     * parse 
     * 
     * @param mixed $query 
     * @access public
     * @return void
     */
    public function parse($query)
    {
        $queries = array();
        parse_str($query, $queries);

        return new Query($this->parseHttpQueryComponents($queries), $this->getPersister());
    }

    /**
     * parseComonents 
     * 
     * @param array $queryComponents 
     * @access public
     * @return void
     */
    public function parseHttpQueryComponents(array $queryComponents = array())
    {
        $statement = new Statement();

        foreach($queryComponents as $key => $part) {
            $clause = $this->getClauseForHttpQueryKey($key);
            $statement->setClause($clause, $this->parseClause($part, $clause));
        }

        return $statement;
    }

    /**
     * parseClause 
     * 
     * @param mixed $query 
     * @param mixed $part 
     * @abstract
     * @access public
     * @return void
     */
    abstract public function parseClause($query, $part);

    public function guessQueryKeyForClause($key)
    {
        if(false !== ($pos = array_search($key, $this->queryComponentKeys))) {
            return $pos;
        }

        return false;
    }
    /**
     * isSupportedHttpQueryKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function isSupportedHttpQueryKey($key)
    {
        return isset($this->queryComponentKeys[$key]);
    }

    /**
     * removeHttpQueryKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function removeHttpQueryKey($key)
    {
        unset($this->queryComponentKeys[$key]);
    }

    /**
     * getClauseForHttpQueryKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function getClauseForHttpQueryKey($key)
    {
        return $this->queryComponentKeys[$key];
    }

    /**
     * setClauseForHttpQueryKey 
     * 
     * @param mixed $key 
     * @param mixed $clause 
     * @access public
     * @return void
     */
    public function setClauseForHttpQueryKey($key, $clause)
    {
        $this->queryComponentKeys[$key] = $clause;
    }
    
    public function getPersister()
    {
        return $this->persister;
    }
    
    public function setPersister(Persister $persister)
    {
        $this->persister = $persister;
        return $this;
    }
}

