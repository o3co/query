<?php
namespace O3Co\Query\Extension\Http;

/**
 * Client 
 *   Interface of Query Client which provides lookup method to fetch. 
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
interface Client
{
    /**
     * lookup 
     * 
     * @param array $queryParts http query components. Such as 'q' for query, 'size' for fetch size. etc.
     * @access public
     * @return void
     */
    function lookup(array $queryParts = array());
}
