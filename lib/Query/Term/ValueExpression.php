<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;

/**
 * ValueExpression 
 * 
 * @uses AbstractTerm
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValueExpression extends AbstractTerm 
{
    /**
     * value 
     * 
     * @var mixed
     * @access private
     */
    private $value;

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

    public function isNull()
    {
        return null === $this->value;
    }

    public function isNumeric()
    {
        return is_numeric($this->value);
    }

    public function isCollection()
    {
        return is_array($this->value);
    }

    public function isString()
    {
        return is_string($this->value);
    }

    public function isBoolean()
    {
        return is_bool($this->value);
    }
}

