<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * ValueIdentifier
 *   Value identifier hold the value as parsed, php value.
 *   Ex)  array('foo', 'bar') is still a Value of identifier. 
 *        We do not parse as Collection[Value('foo'), Value('bar')] like AST does
 * @uses AbstractTerm
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValueIdentifier extends AbstractTerm 
{
    /**
     * value 
     * 
     * @var mixed
     * @access private
     */
    private $value;

    /**
     * __construct 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * getValue 
     * 
     * @access public
     * @return void
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * setValue 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * isNull 
     * 
     * @access public
     * @return void
     */
    public function isNull()
    {
        return null === $this->value;
    }

    /**
     * isNumeric 
     * 
     * @access public
     * @return void
     */
    public function isNumeric()
    {
        return is_numeric($this->value);
    }

    /**
     * isCollection 
     * 
     * @access public
     * @return void
     */
    public function isCollection()
    {
        return is_array($this->value);
    }

    /**
     * isString 
     * 
     * @access public
     * @return void
     */
    public function isString()
    {
        return is_string($this->value);
    }

    /**
     * isBoolean 
     * 
     * @access public
     * @return void
     */
    public function isBoolean()
    {
        return is_bool($this->value);
    }
}

