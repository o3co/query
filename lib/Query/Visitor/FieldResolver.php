<?php
namespace O3Co\Query\Query\Visitor;

/**
 * FieldResolver 
 *   Resolve field name for the visitor.
 *   Relational Database's field may cointain dot to describe the relational association
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FieldResolver
{
    /**
     * canResolveField 
     *    
     * @param string $field 
     * @access public
     * @return bool 
     */
    function canResolveField($field);

	/**
	 * resolveField 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function resolveField($field, array $options = array());
}
