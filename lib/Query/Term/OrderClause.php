<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * OrderClause 
 * 
 * @uses AbstractClause
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class OrderClause extends AbstractClause
{
	/**
	 * add 
	 * 
	 * @param Term $term 
	 * @access public
	 * @return void
	 */
	public function add(Term $term)
	{
		if(!$term instanceof OrderExpression) {
			throw new \InvalidArgumentException('OrderClause only accept OrderExpression as its term.');
		}

		return parent::add($term);
	}
}

