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
     * andX 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function andX($value)
	{
		if(!is_array($value)) {
			// get arguments 
			$value = func_get_args();
		}
		// Convert all values to 
		$conds = array_map(function($v) {
				if(!$v instanceof Term\ConditionalExpression) {
					return $this->buildPart($v);
				}
				return $v;
			}, $value);
		return new Term\LogicalExpression($conds, Term\LogicalExpression::TYPE_AND);
	}

    /**
     * orX 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function orX($value)
	{
		if(!is_array($value)) {
			// get arguments 
			$value = func_get_args();
		}
		// Convert all values to 
		$conds = array_map(function($v) {
				if(!$v instanceof Term\ConditionalExpression) {
					return $this->buildPart($v);
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
			$value = $this->buildPart($value);
		}
		//return new Term\Not($value);
		return new Term\LogicalExpression($value, Term\LogicalExpression::TYPE_NOT);
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
		return new Term\Any($field, Term\ComparisonExpression::IS_NOT);
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
		return new Term\Any($field);
	}

    /**
     * isAny 
     * 
     * @access public
     * @return void
     */
	public function isAny()
	{
		return new Term\Any($field);
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
			$queryParser = $this->getQueryParser();
			if($queryParser) {
				return $queryParser->parseClausePart($value);
			} else {
				return new Term\ValueIdentifier($value);
			}
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

