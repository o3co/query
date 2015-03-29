<?php
namespace O3Co\Query\Tests;

use O3Co\Query\Query\Visitor\OuterVisitor;
use O3Co\Query\Query\Term;

/**
 * TestVisitor 
 * 
 * @uses OuterVisitor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
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
     * @param Term $term 
     * @access public
     * @return void
     */
    public function visit(Term $term)
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

