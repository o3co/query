<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Part;

/**
 * TreeVisitor 
 * 
 * @uses SequentialVisitor
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class TreeVisitor implements Visitor 
{
    private $visitors = array();

    public function __construct(array $visitors = array())
    {
        foreach($visitors as $visitor) {
            $this->append($visitor);
        }
    }

    public function visit(Part $expr)
    {
        //
        return $expr->dispatch($this);
    }

    public function visitStatement(Part\Statement $statement)
    {
        foreach($this->visitors as $visitor) {
            $statement->dispatch($visitor);
        }

        // traverse tree
        foreach($statement->getClauses() as $clause) {
            $clause->dispatch($this);
        }
    }

    public function visitConditionalClause(Part\ConditionalClause $clause)
    {
        foreach($this->visitors as $visitor) {
            $clause->dispatch($visitor);
        }
    }

    public function visitLimitClause(Part\LimitClause $limit)
    {
    }

    public function visitOffsetClause(Part\OffsetClause $offset)
    {
    }

    public function visitOrderClause(Part\OrderClause $order)
    {
    }
    
    public function getVisitors()
    {
        return $this->visitors;
    }
    
    public function setVisitors(array $visitors)
    {
        $this->visitors = array();
        
        foreach($visitors as $visitor) {
            $this->append($visitor);   
        }
        return $this;
    }

    public function prepend(Visitor $visitor)
    {
        array_unshift($this->visitors, $visitor);
    }

    public function append(Visitor $visitor)
    {
        array_push($this->visitors, $visitor);
    }
}

