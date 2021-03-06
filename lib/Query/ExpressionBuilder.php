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
                if(!$v instanceof Expr\ConditionalExpression) {
                    throw new \InvalidArgumentException(sprintf('arguments of andx has to be an array of ConditionalExpresion, but "%s" is given', is_object($v) ? get_class($v) : gettype($v)));
                    //return $this->buildPart($v);
                }
                return $v;
            }, $value);
        return new Expr\LogicalExpression($conds, Expr\LogicalExpression::TYPE_AND);
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
                } else if(!$v instanceof Expr\ConditionalExpression) {
                    throw new \InvalidArgumentException('');
                } 
                return $v;
            }, $value);

        //return new Expr\OrX($conds);
        return new Expr\LogicalExpression($conds, Expr\LogicalExpression::TYPE_OR);
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
        if(!$value instanceof Expr\ConditionalExpression) {
            throw new \InvalidArgumentException('ExpressionBuilder::not only accept ConditionalExpression as argument 1');
        }
        //return new Expr\Not($value);
        return new Expr\LogicalExpression(array($value), Expr\LogicalExpression::TYPE_NOT);
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
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::EQ);
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
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::NEQ);
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
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::GT);
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
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::GTE);
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
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::LT);
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
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\ComparisonExpression($field, $value, Expr\ComparisonExpression::LTE);
    }

    public function in($field, $values)
    {
        if(is_array($values)) {
            return new Expr\CollectionComparisonExpression($field, $this->buildPart($values), Expr\CollectionComparisonExpression::IN);
        } else {
            return new Expr\CollectionComparisonExpression($field, $this->buildPart(array($values)), Expr\CollectionComparisonExpression::IN);
        }
    }

    /**
     * match 
     *   Pattern search 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function match($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\TextComparisonExpression($field, $value, Expr\TextComparisonExpression::MATCH);
    }

    /**
     * match 
     *   Pattern search 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function notMatch($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\TextComparisonExpression($field, $value, Expr\TextComparisonExpression::NOT_MATCH);
    }

    /**
     * prefix 
     *   Match prefix 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function prefix($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart(Expr\TextComparisonExpression::escapeString((string)$value) . Expr\TextComparisonExpression::WILDCARD_STRING);
        }
        return new Expr\TextComparisonExpression($field,  $value, Expr\TextComparisonExpression::MATCH);
    }

    /**
     * postfix 
     *   Match postfix 
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function postfix($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart(Expr\TextComparisonExpression::WILDCARD_STRING . Expr\TextComparisonExpression::escapeString((string)$value));
        }
        return new Expr\TextComparisonExpression($field, $value, Expr\TextComparisonExpression::MATCH);
    }

    /**
     * contains 
     *   Contains is as same as "*value*" match
     * @param mixed $field 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function contains($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\TextComparisonExpression($field, $value, Expr\TextComparisonExpression::CONTAIN);
    }

    public function notContains($field, $value)
    {
        if(!$value instanceof Expr\ConditionalExpression) {
            $value = $this->buildPart($value);
        }
        return new Expr\TextComparisonExpression($field, $value, Expr\TextComparisonExpression::NOT_CONTAIN);
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
        return new Expr\ComparisonExpression($field, new Expr\ValueIdentifier(null), Expr\ComparisonExpression::EQ);
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
        return new Expr\ComparisonExpression($field, new Expr\ValueIdentifier(null), Expr\ComparisonExpression::NEQ);
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

    /**
     * asc 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function asc($field)
    {
        return new Expr\OrderExpression($field, Expr\OrderExpression::ORDER_ASCENDING);
    }

    /**
     * desc 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function desc($field)
    {
        return new Expr\OrderExpression($field, Expr\OrderExpression::ORDER_DESCENDING);
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
            return new Expr\ValueIdentifier($value);
        } else if(is_scalar($value) || is_array($value)) {
            return new Expr\ValueIdentifier($value);
        }if($value instanceof Part) {
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

