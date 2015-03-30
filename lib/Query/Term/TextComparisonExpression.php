<?php
namespace O3Co\Query\Query\Term;

/**
 * Match 
 *   TextComparison Match is an expression as WILECARD matching
 *   "LIKE %" for SQL, "*" for Lucene and other FTS. 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TextComparisonExpression extends AbstractComparisonExpression 
{
    const BIT_ALL         = 0b0110000000110000;
    const BIT_OP          = 0b1000000000110000;
    const BIT_NOT         = 0b1000000000000000;
    const BIT_MATCH       = 0b0000000000010000;
    const BIT_CONTAIN     = 0b0000000000100000;
    const BIT_IS_MUST     = 0b0010000000000000;

    const MATCH        = 0b0000000000010000;
    const CONTAIN      = 0b0000000000100000;
    const NOT_MATCH    = 0b1000000000010000;
    const NOT_CONTAIN  = 0b1000000000100000;

    public function cleanOperator()
    {
        $this->operator &= self::BIT_ALL;

        // if both contain and match bit is flagged, 
        if((self::BIT_CONTAIN | self::BIT_MATCH) === ($this->operator & (self::BIT_MATCH | self::BIT_CONTAIN))) {
            // invalid operator
            throw new UnsupportedException('Match and Contain cannot bit on the same time.');
        }

        return $this->operator;
    }
}

