<?php
namespace O3Co\Query\Query\Term;

/**
 * ComparisonExpression 
 * 
 * @uses ConditionalExpression
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ComparisonExpression extends AbstractComparisonExpression
{
    // Used 0b1100000000000111
    const BIT_ALL        = 0b1100000000000111;
    const BIT_OP         = 0b1000000000000111;
    const BIT_EQ         = 0b0000000000000001;
    const BIT_GT         = 0b0000000000000010;
    const BIT_LT         = 0b0000000000000100;
    const BIT_VALUE_ANY  = 0b0100000000000000;

    // Simple Operator
    const EQ          = 0b0000000000000001;
    const NEQ         = 0b1000000000000001;
    const GT          = 0b0000000000000010;
    const GTE         = 0b0000000000000011;
    const LT          = 0b0000000000000100;
    const LTE         = 0b0000000000000101;
    // ALIAS of EQ and NEQ
    const IS          = 0b0000000000000001;
    const IS_NOT      = 0b1000000000000001;
}

