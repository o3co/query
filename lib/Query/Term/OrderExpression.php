<?php
namespace O3Co\Query\Query\Term;

/**
 * OrderExpression 
 * 
 * @uses AbstractFieldDeclaredExpression 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class OrderExpression extends AbstractFieldDeclaredExpression implements Expression 
{
    const ORDER_ASCENDING  = 0;
    const ORDER_DESCENDING = 1;

    /**
     * orderType 
     * 
     * @var mixed
     * @access private
     */
    private $orderType;

    /**
     * __construct 
     * 
     * @param mixed $field 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function __construct($field, $type = self::ORDER_ASCENDING)
    {
        parent::__construct($field);
        $this->orderType = $type;
    }

    /**
     * isAsc 
     * 
     * @access public
     * @return void
     */
    public function isAsc()
    {
        return self::ORDER_ASCENDING == $this->orderType;
    }

    /**
     * isDesc 
     * 
     * @access public
     * @return void
     */
    public function isDesc()
    {
        return self::ORDER_DESCENDING == $this->orderType;
    }
    
    /**
     * getOrderType 
     * 
     * @access public
     * @return void
     */
    public function getOrderType()
    {
        return $this->orderType;
    }
}

