<?php
namespace O3Co\Query\Extension\Http;

/**
 * Client 
 *   Interface of Query Client which provides lookup method to fetch. 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Client
{
	/**
	 * lookup 
	 * 
	 * @param array $queryParts http query components. Such as 'q' for query, 'size' for fetch size. etc.
     * @param integer $size Fetch size
     * @param integer $offset Fetch offset where the fetch result begin at.
	 * @access public
	 * @return void
	 */
	function lookup(array $queryParts = array(), $size = null, $offset = 0);
}
