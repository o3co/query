<?php
namespace O3Co\Query;

/**
 * Parser 
 *   Parse given query string to the SimpleExpression
 *   O3Co\Query only provides ProviderInterface, but this is not used on any.
 *   If you need to create your own, you do not need to impl this Interface
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
interface Parser
{
    /**
     * parse
     * 
     * @param mixed $query 
     * @access public
     * @return void
     */
    function parse($query);

    /**
     * parseClause 
     * 
     * @param mixed $query 
     * @access public
     * @return void
     */
    function parseClause($query, $part);

    /**
     * parseConditionalExpression 
     * 
     * @param mixed $query 
     * @access public
     * @return void
     */
    function parseConditionalExpression($query);
}
