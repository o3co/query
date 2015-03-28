<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Visitor;
use O3Co\Query\Query\Term;

/**
 * SequentialVisitor 
 * 
 * @uses Visitor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialVisitor implements Visitor
{
    /**
     * visitors 
     * 
     * @var array
     * @access private
     */
    private $visitors = array();

    /**
     * visit 
     *    
     * @param Term $expr 
     * @access public
     * @return mixed Return the latest visitor response 
     */
    public function visit(Term $expr)
    {
        $response = null;
        foreach($visitors as $visitor) {
            $response = $visitor->visit($expr);
        }

        return $response;
    }
    
    /**
     * getVisitors 
     * 
     * @access public
     * @return void
     */
    public function getVisitors()
    {
        return $this->visitors;
    }
    
    /**
     * setVisitors 
     * 
     * @param array $visitors 
     * @access public
     * @return void
     */
    public function setVisitors(array $visitors)
    {
        $this->visitors = array();
        foreach($visitors as $visitor) {
            $this->append($visitor);
        }
        return $this;
    }

    /**
     * prepend 
     * 
     * @param Visitor $visitor 
     * @access public
     * @return void
     */
    public function prepend(Visitor $visitor)
    {
        array_unshift($this->visitors, $visitor);
    }

    /**
     * append 
     * 
     * @param Visitor $visitor 
     * @access public
     * @return void
     */
    public function append(Visitor $visitor)
    {
        array_push($this->visitors, $visitor);
    }
}

