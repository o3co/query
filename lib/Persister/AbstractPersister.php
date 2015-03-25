<?php
namespace O3Co\Query\Persister;

use O3Co\Query\Persister;
use O3Co\Query\Query;
use O3Co\Query\Query\Visitor;

/**
 * AbstractPersister 
 * 
 * @uses Persister
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractPersister implements Persister
{
    /**
     * outerVisitor 
     * 
     * @var mixed
     * @access private
     */
    private $outerVisitor;

    public function __construct(Visitor $outerVisitor)
    {
        $this->outerVisitor = $outerVisitor;
    }

    /**
     * getNativeQuery 
     * 
     * @param Query $query 
     * @access public
     * @return void
     */
    public function getNativeQuery(Query $query, array $options = array())
    {
        $visitor = $this->getOuterVisitor();
        // Visit SimpleExpressions
        $query->getStatement()->dispatch($visitor);
        
        // Get NativeQuery from the Visitor
        return $visitor->getNativeQuery($options);
    }
    
    /**
     * getOuterVisitor 
     * 
     * @access public
     * @return void
     */
    public function getOuterVisitor()
    {
        return $this->outerVisitor;
    }
    
    /**
     * setOuterVisitor 
     * 
     * @param Visitor $outerVisitor 
     * @access public
     * @return void
     */
    public function setOuterVisitor(Visitor $outerVisitor)
    {
        $this->outerVisitor = $outerVisitor;
        return $this;
    }
}
