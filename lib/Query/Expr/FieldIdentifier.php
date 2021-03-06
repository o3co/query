<?php
namespace O3Co\Query\Query\Expr;

use O3Co\Query\Query\Expr;

/**
 * FieldIdentifier 
 * 
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class FieldIdentifier implements Part
{
    /**
     * name
     * 
     * @var string
     * @access private
     */
    private $name;

    /**
     * __construct 
     * 
     * @param string $name
     * @access public
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

