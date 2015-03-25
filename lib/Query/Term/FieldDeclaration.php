<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * FieldDeclaration 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class FieldDeclaration implements Term
{
	/**
	 * field 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $field;

	/**
	 * __construct 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function __construct($field)
	{
		$this->field = $field;
	}
    
    /**
     * getField 
     * 
     * @access public
     * @return void
     */
    public function getField()
    {
        return $this->field;
    }
}

