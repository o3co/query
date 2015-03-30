<?php
namespace O3Co\Query\Extension\Extra;

use O3Co\Query\Extension\Http\ProxyClient;
use O3Co\Query\Query\SimpleQueryBuilder;
use O3Co\Query\Extension\CQL\CQLPersister;

/**
 * CQLClient 
 * 
 * @uses ProxyClient
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class CQLClient extends ProxyClient 
{
    /**
     * createQueryBuilder 
     * 
     * @access public
     * @return void
     */
    public function createQueryBuilder()
    {
        return new SimpleQueryBuilder(new CQLPersister($this));
    }
}

