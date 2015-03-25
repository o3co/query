<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * Clause 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Clause
{
	/**
	 * getTerms 
	 * 
	 * @access public
	 * @return void
	 */
	function getTerms();

	/**
	 * add 
	 * 
	 * @param Term $term 
	 * @access public
	 * @return void
	 */
	function add(Term $term);
}

