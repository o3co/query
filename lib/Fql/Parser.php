<?php
namespace O3Co\Query\Fql;

/**
 * Parser 
 *    Parse Fql query to expression 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Parser
{
    /**
     * parseFql 
     *   Parse field query and generate represented SimpleExpression. 
     * @param string $field
     * @param mixed $query
     * @access public
     * @return Expression
     * @throw \O3Co\Query\Exception\ParserException
     */
    function parseFql($field, $query);
}
