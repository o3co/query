<?php
namespace O3Co\Query\Extension\Http;

use O3Co\Query\Parser as ParserInterface;
use O3Co\Query\Query\Term\Statement;

/**
 * AbstractParser 
 *   Abstract Parser for Http Based Query 
 * @uses ParserInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractParser implements ParserInterface 
{
	/**
	 * queryComponentKeys 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $queryComponentKeys;

	/**
	 * __construct 
	 * 
	 * @param array $keys 
	 * @access public
	 * @return void
	 */
	public function __construct(array $keys = array())
	{
		$this->queryComponentKeys = $keys; 
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

        return $this->parseComponents($queries);
    }

    /**
     * parseComonents 
     * 
     * @param array $queryComponents 
     * @access public
     * @return void
     */
    public function parseComonents(array $queryComponents = array())
    {
		$statement = new Statement();

		foreach($this->queryComponentKeys as $part => $key) {
			if(isset($queries[$key])) {
				$statement->setClause($part, $this->parseClause($queries[$key], $part));
			}
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

	/**
	 * hasQueryKeyFor 
	 * 
	 * @param mixed $part 
	 * @access public
	 * @return void
	 */
	public function hasQueryKeyFor($part)
	{
		return isset($this->queryComponentKeys[$part]);
	}

	/**
	 * removeQueryKeyFor 
	 * 
	 * @param mixed $part 
	 * @access public
	 * @return void
	 */
	public function removeQueryKeyFor($part)
	{
		unset($this->queryComponentKeys[$part]);
	}

	/**
	 * getQueryKeyFor 
	 * 
	 * @param mixed $part 
	 * @access public
	 * @return void
	 */
	public function getQueryKeyFor($part)
	{
		return $this->queryComponentKeys[$part];
	}

	/**
	 * setQueryKeyFor 
	 * 
	 * @param mixed $part 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function setQueryKeyFor($part, $key)
	{
		$this->queryComponentKeys[$part] = $key;
	}
}

