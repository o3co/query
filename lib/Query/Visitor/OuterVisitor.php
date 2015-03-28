<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;

/**
 * OuterVisitor 
 *    Interface for OuterVisitor which generate the actual native query. 
 * @uses Visitor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface OuterVisitor extends Visitor
{
    /**
     * getNativeQuery 
     *   Get native query from visited   
     * @access public
     * @return void
     */
    function getNativeQuery();
}
