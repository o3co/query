<?php
namespace O3Co\Query\Extension\Extra\Tests;

use GuzzleHttp\Client as GuzzleClient;
use O3Co\Query\Extension\Extra\CQLClient;
use O3Co\Query\Bridge\GuzzleHttp\ProxyClient as GuzzleProxyClient;

/**
 * CQLClientTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class CQLClientTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testQuery 
     * 
     * @access public
     * @return void
     */
    public function testQuery()
    {
        $client = new CQLClient(new GuzzleProxyClient(new GuzzleClient(), 'http://hoge', 'get'));

        $qb = $client->createQueryBuilder();
        $this->assertInstanceof('O3Co\Query\Query\SimpleQueryBuilder', $qb);
        $this->assertInstanceof('O3Co\Query\Extension\CQL\CQLPersister', $qb->getPersister());
    }
}

