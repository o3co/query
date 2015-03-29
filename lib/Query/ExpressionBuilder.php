<?php
namespace O3Co\Query\Query;

use O3Co\Query\Exception\UnsupportedException;
use O3Co\Query\Query\Term;

/**
 * ExpressionBuilder 
 *    ExpresionBuilder for default simple expression or extended.
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
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
				if(!$v instanceof Term\ConditionalExpression) {
                    throw new \InvalidArgumentException(sprintf('arguments of andx has to be an array of ConditionalExpresion, but "%s" is given', is_object($v) ? get_class($v) : gettype($v)));
					//return $this->buildPart($v);
				}
				return $v;
			}, $value);
		return new Term\LogicalExpression($conds, Term\LogicalExpression::TYPE_AND);
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
                } else if(!$v instanceof Term\ConditionalExpression) {
                    throw new \InvalidArgumentException('');
				} 
				return $v;
			}, $value);

		//return new Term\OrX($conds);
		return new Term\LogicalExpression($conds, Term\LogicalExpression::TYPE_OR);
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
		if(!$value instanceof Term\ConditionalExpression) {
            throw new \InvalidArgumentException('ExpressionBuilder::not only accept ConditionalExpression as argument 1');
		}
		//return new Term\Not($value);
		return new Term\LogicalExpression(array($value), Term\LogicalExpression::TYPE_NOT);
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
		if(!$value instanceof Term) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::EQ);
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
		if(!$value instanceof Term) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::NEQ);
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
		if(!$value instanceof Term\ConditionalExpression) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::GT);
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
		if(!$value instanceof Term\ConditionalExpression) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::GTE);
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
		if(!$value instanceof Term) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::LT);
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
		if(!$value instanceof Term\ConditionalExpression) {
			$value = $this->buildPart($value);
		}
		return new Term\ComparisonExpression($field, $value, Term\ComparisonExpression::LTE);
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
		return new Term\ComparisonExpression($field, new Term\ValueIdentifier(null), Term\ComparisonExpression::EQ);
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
		return new Term\ComparisonExpression($field, new Term\ValueIdentifier(null), Term\ComparisonExpression::NEQ);
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
			return new Term\ValueIdentifier($value);
		} else if(is_scalar($value)) {
			return new Term\ValueIdentifier($value);
		} else if($value instanceof Term) {
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

