<?php
namespace O3Co\Query\Query\Term;

/**
 * AbstractFieldConditionExpression 
 * 
 * @uses AbstractTerm
 * @uses Expression
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractFieldDeclaredExpression extends AbstractTerm implements FieldDeclaredExpression 
{
    /**
     * field 
     * 
     * @var mixed
     * @access protected
     */
    protected $field;

    /**
     * __construct 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function __construct($field)
    {
        if(is_string($field)) {
            $field = new FieldIdentifier($field);
        }
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
    
    /**
     * setField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function setField($field)
    {
        if(is_string($field)) {
            $field = new FieldIdentifier($field);
        }
        $this->field = $field;
        return $this;
    }
}

