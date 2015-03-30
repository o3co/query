<?php
namespace O3Co\Query\Query;

use O3Co\Query\Exception\UnsupportedException;
use O3Co\Query\Query\Expr;

/**
 * ExpressionBuilder 
 *    ExpresionBuilder for default simple expression or extended.
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class ExpressionBuilder 
{
    // Conditional Expression
    /**
     * andx 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function andx($value)
    {
        if(!is_array($value)) {
            // get arguments 
            $value = func_get_args();
        }

        // Convert all values to 
        $conds = array_map(function($v) {
                if(!$v instanceof Part\ConditionalExpression) {
                    throw new \InvalidArgumentException(sprintf('arguments of andx has to be an array of ConditionalExpresion, but "%s" is given', is_object($v) ? get_class($v) : gettype($v)));
                    //return $this->buildPart($v);
                }
                return $v;
            }, $value);
        return new Part\LogicalExpression($conds, Part\LogicalExpression::TYPE_AND);
    }

    /**
     * orx 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function orx($value)
    {
        if(!is_array($value)) {
            // get arguments 
            $value = func_get_args();
        }
        // Convert all values to 
        $conds = array_map(function($v) {
                if(is_string($v) && $this->getQueryParser()) {
                    return $this->getQueryParser()->parseExpression($v);
                } else if(!$v instanceof Part\ConditionalExpression) {
                    throw new \InvalidArgumentException('');
                } 
                return $v;
            }, $value);

        //return new Part\OrX($conds);
        return new Part\LogicalExpression($conds, Part\LogicalExpression::TYPE_OR);
    }

    /**
     * not 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function not($value)
    {
        if(!$value instanceof Part\ConditionalExpression) {
            throw new \InvalidArgumentException('ExpressionBuilder::not only accept ConditionalExpression as argument 1');
        }
        //return new Part\Not($value);
        return new Part\LogicalExpression(array($value), Part\LogicalExpression::TYPE_NOT);
    }

    // Comparison Expression
    /**
     * eq 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function eq($field, $value)
    {
        if(!$value instanceof Part) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::EQ);
    }

    /**
     * neq 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function neq($field, $value)
    {
        if(!$value instanceof Part) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::NEQ);
    }

    /**
     * gt 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function gt($field, $value)
    {
        if(!$value instanceof Part\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::GT);
    }

    /**
     * gte 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function gte($field, $value)
    {
        if(!$value instanceof Part\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::GTE);
    }

    /**
     * lt 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function lt($field, $value)
    {
        if(!$value instanceof Part) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::LT);
    }

    /**
     * lte 
     * 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function lte($field, $value)
    {
        if(!$value instanceof Part\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Part\ComparisonExpression($field, $value, Part\ComparisonExpression::LTE);
    }

    /**
     * isNull 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function isNull($field)
    {
        return new Part\ComparisonExpression($field, new Part\ValueIdentifier(null), Part\ComparisonExpression::EQ);
    }

    /**
     * isNotNull 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function isNotNull($field)
    {
        return new Part\ComparisonExpression($field, new Part\ValueIdentifier(null), Part\ComparisonExpression::NEQ);
    }

    /**
     * isAny 
     *   Alias of isNotNull 
     * @access public
     * @return void
     */
    public function isAny($field)
    {
        return $this->isNotNull($field);
    }

    public function asc($field)
    {
        return new Part\OrderExpression($field, Part\OrderExpression::ORDER_ASCENDING);
    }

    public function desc($field)
    {
        return new Part\OrderExpression($field, Part\OrderExpression::ORDER_DESCENDING);
    }

    /**
     * buildPart 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function buildPart($value)
    {
        if(is_string($value)) {
            // try to parse the value with CQL Parser
            return new Part\ValueIdentifier($value);
        } else if(is_scalar($value)) {
            return new Part\ValueIdentifier($value);
        } else if($value instanceof Part) {
            return $value;
        }

        throw new UnsupportedException(sprintf('Unsupported type [%s] to build part.', gettype($value))); 
    }

    /**
     * getQueryParser 
     * 
     * @access public
     * @return void
     */
    public function getQueryParser()
    {
        return false;
    }
}

