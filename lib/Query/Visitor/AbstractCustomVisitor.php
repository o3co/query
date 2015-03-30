<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Term;

/**
 * AbstractCustomVisitor 
 * 
 * @uses Visitor
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractCustomVisitor implements Visitor 
{
    public function visit(Term $term)
    {
    }
}

