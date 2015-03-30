<?php
namespace O3Co\Query\Query\Part;

abstract class AbstractComparisonExpression extends AbstractFieldDeclaredExpression implements ConditionalExpression 
{
    const BIT_ALL        = 0b1111111111111111;
    const BIT_NOT        = 0b1000000000000000;

    /**
     * operator 
     * 
     * @var mixed
     * @access protected
     */
    protected $operator;

    /**
     * field 
     * 
     * @var mixed
     * @access protected
     */
    protected $field;

    /**
     * value 
     * 
     * @var mixed
     * @access protected
     */
    protected $value;

    /**
     * __construct 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @param mixed $operator 
     * @access public
     * @return void
     */
    public function __construct($field, ValueIdentifier $value, $operator)
    {
        parent::__construct($field);
        $this->value = $value;
        $this->operator = 0;
        
        $this->setOperator($operator);
    }

    /**
     * not 
     * 
     * @param mixed $op 
     * @static
     * @access public
     * @return void
     */
    public function not()
    {
        $this->operator = static::TYPE_NOT ^ $this->operator;
    }

    /**
     * getValue 
     * 
     * @access public
     * @return ValueIdentifier 
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
     * getOperator 
     * 
     * @access public
     * @return void
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * setOperator 
     * 
     * @param mixed $operator 
     * @access public
     * @return void
     */
    public function setOperator($operator)
    {
        $this->operator = $operator & static::BIT_ALL;
        return $this;
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
    
    /**
     * setField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
}

