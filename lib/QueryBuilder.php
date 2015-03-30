<?php
namespace O3Co\Query;

/**
 * QueryBuilder 
 * 
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
interface QueryBuilder 
{
    /**
     * getQuery 
     *   Get Built Query
     * @access public
     * @return Query
     */
    public function getQuery();

    /**
     * expr 
     * 
     * @access public
     * @return ExpressionBuilder 
     */
    public function expr();

    /**
     * add 
     * 
     * @param mixed $expr 
     * @access public
     * @return void
     */
    public function add($expr);

    /**
     * setMaxResults 
     * 
     * @param integer $limit 
     * @access public
     * @return QueryBuilder 
     */
    public function setMaxResults($limit);

    /**
     * setFirstResult 
     * 
     * @param interger $offset 
     * @access public
     * @return QueryBuilder 
     */
    public function setFirstResult($offset);
}

