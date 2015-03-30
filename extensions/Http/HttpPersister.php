<?php
namespace O3Co\Query\Extension\Http;

use O3Co\Query\Query;
use O3Co\Query\Persister;
use O3Co\Query\Persister\AbstractPersister;
/**
 * HttpPersister 
 *   HttpPersister is a Persister.
 *   This type of persister create Http based query string, and execute with Http Client.
 *   To dispatch to HttpClient, HttpPersister requires the Client implemnets Http\Client interface.
 * 
 *   Commonly, HttpPersister is extended with Specified Visitor.
 * 
 * @uses Persister
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class HttpPersister extends AbstractPersister implements Persister 
{
    /**
     * client 
     * 
     * @var mixed
     * @access private
     */
    private $client;

    /**
     * execute 
     * 
     * @param Query $query 
     * @access public
     * @return void
     */
    public function execute(Query $query)
    {
        // Get native query for SimpleExpression
        $nativeQuery = $this->getNativeQuery($query);

        $queryParts = array();
        parse_str($nativeQuery, $queryParts);

        // pass http query parts 
        return $this->getClient()->lookup($queryParts);
    }
    
    /**
     * getClient 
     * 
     * @access public
     * @return void
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * setClient 
     * 
     * @param Client $client 
     * @access public
     * @return void
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }
}

