<?php
namespace O3Co\Query\Extension\Http;

/**
 * ProxyClient 
 * 
 * @uses Client
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class ProxyClient implements Client 
{
    /**
     * client 
     * 
     * @var mixed
     * @access private
     */
    private $client;

    /**
     * __construct 
     * 
     * @param Client $client 
     * @access public
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * lookup 
     * 
     * @param array $queris 
     * @param mixed $size 
     * @param int $offset 
     * @access public
     * @return void
     */
    public function lookup(array $queris = array())
    {
        return $this->getClient()->lookup($queries);
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

