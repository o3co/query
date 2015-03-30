<?php
namespace O3Co\Query\Query\Term;

/**
 * MultiExpressionPart 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface MultiExpressionPart
{
    /**
     * getExpressions 
     * 
     * @access public
     * @return void
     */
    function getExpressions();

    /**
     * addExpression 
     * 
     * @param Expression $expr 
     * @access public
     * @return void
     */
    function addExpression(Expression $expr);
}

