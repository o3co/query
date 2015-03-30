<?php
namespace O3Co\Query\Query\Term;

/**
 * CollectionComparisonExpression 
 * 
 * @uses FieldExpression
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CollectionComparisonExpression extends AbstractComparisonExpression implements ConditionalExpression 
{
    const BIT_ALL        = 0b1000000000000001;
    const BIT_NOT        = 0b1000000000000000;

    const IN             = 0b0000000000000001;
    const NOT_IN         = 0b1000000000000001;
}

