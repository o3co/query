<?php
namespace O3Co\Query\Query\Part;

/**
 * Range 
 *   Expression Range is as [min to max] notation 
 * 
 * @uses ConditionalExpression
 * @uses FieldExpressoin
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class RangeExpression extends AbstractFieldDeclaredExpression implements ConditionalExpression
{
    /**
     * minComparison 
     * 
     * @var mixed
     * @access private
     */
    private $minComparison;

    /**
     * maxComparison 
     * 
     * @var mixed
     * @access private
     */
    private $maxComparison;

    /**
     * __construct 
     * 
     * @param mixed $field 
     * @param ComparisonExpression $minComparison 
     * @param ComparisonExpression $maxComparison 
     * @access public
     * @return void
     */
    public function __construct($field, ComparisonExpression $minComparison = null, ComparisonExpression $maxComparison = null)
    {
        parent::__construct($field);

        if(!$minComparison && !$maxComparison) {
            throw new \Exception('Both min and max cannot be any.');
        } else if( (!$minComparison && ($maxComparison->getValue()->isNull))
            || (!$maxComparison && ($minComparison->getValue()->isNull())) ) 
        {
            throw new \Exception('Both min and max cannot be any.');
        }
        
        if(!$minComparison) {
            $minComparison = new Part\ComparisonExpression($field, null, Part\ComparisonExpression::BIT_VALUE_ANY | Part\ComparisonExpression::EQ );
        } else if(!$maxComparison) {
            $maxComparison = new Part\ComparisonExpression($field, null, Part\ComparisonExpression::BIT_VALUE_ANY | Part\ComparisonExpression::EQ );
        }

        $this->setMinComparison($minComparison);
        $this->setMaxComparison($maxComparison);
    }
    
    /**
     * getMinComparison 
     * 
     * @access public
     * @return void
     */
    public function getMinComparison()
    {
        return $this->minComparison;
    }
    
    /**
     * setMinComparison 
     * 
     * @param ComparisonExpression $minComparison 
     * @access public
     * @return void
     */
    public function setMinComparison(ComparisonExpression $minComparison)
    {
        if($minComparison->getField() != $this->getField()) {
            throw new \InvalidArgumentException('Field of Minimum Comparison is not equal to field of Range.');
        } else if(($minComparison->getValue()->isNull()) &&  !(ComparisonExpression::GT & $minComparison->getOperator())) {
            throw new \InvalidArgumentException('Range.min has to be an Any or a Greater Comparison.');
        }

        $this->minComparison = $minComparison;
        return $this;
    }
    
    /**
     * getMaxComparison 
     * 
     * @access public
     * @return void
     */
    public function getMaxComparison()
    {
        return $this->maxComparison;
    }
    
    /**
     * setMaxComparison 
     * 
     * @param ComparisonExpression $maxComparison 
     * @access public
     * @return void
     */
    public function setMaxComparison(ComparisonExpression $maxComparison)
    {
        if($maxComparison->getField() != $this->getField()) {
            throw new \InvalidArgumentException('Field of Minimum Comparison is not equal to field of Range.');
        } else if($maxComparison->getValue()->isNull() && !(ComparisonExpression::LT & $maxComparison->getOperator())) {
            throw new \InvalidArgumentException('Range.max has to be an Any or a Less Comparison.');
        }

        $this->maxComparison = $maxComparison;
        return $this;
    }
}
