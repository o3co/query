<?php
namespace O3Co\Query\Query;

use O3Co\Query\Query\Expr\Part;

/**
 * Visitor 
 *   Visitor is an interface of visitor classes which create NativeQuery 
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
interface Visitor
{
    /**
     * visit 
     *   visit Query Part 
     * @param Part $term 
     * @access public
     * @return void
     */
    function visit(Expr\Part $term);
}
