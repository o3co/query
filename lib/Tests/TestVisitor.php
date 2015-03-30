<?php
namespace O3Co\Query\Tests;

use O3Co\Query\Query\Visitor\OuterVisitor;
use O3Co\Query\Query\Expr;

/**
 * TestVisitor 
 * 
 * @uses OuterVisitor
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class TestVisitor implements OuterVisitor
{
    private $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * visit 
     * 
     * @param Part $part 
     * @access public
     * @return void
     */
    public function visit(Expr\Part $part)
    {
        // do nothing
    }

    /**
     * getNativeQuery 
     * 
     * @access public
     * @return void
     */
    public function getNativeQuery()
    {
        return $this->query;
    }

    public function visitStatement($statement)
    {
    }
}

