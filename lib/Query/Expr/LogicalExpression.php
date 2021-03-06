<?php
namespace O3Co\Query\Query\Expr;

/**
 * AndX 
 * 
 * @uses CompoundExpression
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class LogicalExpression extends CompositeExpression implements ConditionalExpression
{
    const TYPE_AND  = 0b0000000000000001;
    const TYPE_OR   = 0b0000000000000010;
    const TYPE_NOT  = 0b0000000000000100;

    /**
     * type 
     * 
     * @var mixed
     * @access private
     */
    private $type;

    /**
     * __construct 
     * 
     * @param array $parts 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function __construct(array $parts = array(), $type = self::TYPE_AND)
    {
        parent::__construct($parts);

        $this->type = $type;
    }
    
    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * isType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function isType($type)
    {
        return $this->type === $type;
    }
}

