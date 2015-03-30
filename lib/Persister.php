<?php
namespace O3Co\Query;

/**
 * Persister 
 *   Persister interface.
 *   Persister is a class to implements logic of fetching data for specified Query.
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
interface Persister
{
    /**
     * execute 
     * 
     * @param Query $query 
     * @access public
     * @return void
     */
    function execute(Query $query);
}
