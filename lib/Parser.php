<?php
namespace O3Co\Query;

/**
 * Parser 
 *   Parse given query string to the SimpleExpression 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
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
}
