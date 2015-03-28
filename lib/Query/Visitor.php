<?php
namespace O3Co\Query\Query;

/**
 * Visitor 
 *   Visitor is an interface of visitor classes which create NativeQuery 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Visitor
{
	/**
	 * visit 
	 *   visit Query Term 
	 * @param Term $term 
	 * @access public
	 * @return void
	 */
	function visit(Term $term);
}
