<?php
namespace O3Co\Query\Persister;

use O3Co\Query\Persister;
use O3Co\Query\Query;
use O3Co\Query\Query\Visitor\OuterVisitor;
use O3Co\Query\Query\Visitor\TreeVisitor;

/**
 * AbstractPersister 
 * 
 * @uses Persister
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractPersister implements Persister
{
    /**
     * customVisitor 
     *   Visitors to modify SimpleExpression 
     * @var mixed
     * @access private
     */
    private $customVisitors;

    /**
     * outerVisitor 
     *   Visitor to output NativeQuery with SimpleExpression 
     * @var mixed
     * @access private
     */
    private $outerVisitor;

    /**
     * __construct 
     * 
     * @param Visitor $outerVisitor 
     * @access public
     * @return void
     */
    public function __construct(OuterVisitor $outerVisitor, array $customVisitors = array())
    {
        $this->customVisitors = new TreeVisitor($customVisitors); 
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
        // Clone the original SimpleExpression
        $statement = clone $query->getStatement();

        // Apply CustomVisitors to modify SimpleExpression
        $customVisitors = $this->getCustomVisitors();
        if($customVisitors) {
            $statement->dispatch($customVisitors);
        }

        // Apply OuterVisitor to output the nativeQuery from SimpleExpression
        $outerVisitor = $this->getOuterVisitor();
        $statement->dispatch($outerVisitor);
        
        // Get NativeQuery from the Visitor
        return $outerVisitor->getNativeQuery($options);
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
    public function setOuterVisitor(OuterVisitor $outerVisitor)
    {
        $this->outerVisitor = $outerVisitor;
        return $this;
    }
    
    public function getCustomVisitors()
    {
        return $this->customVisitors;
    }
    
    public function setCustomVisitors(array $customVisitors)
    {
        $this->customVisitors = new TreeVisitor($customVisitors);
        return $this;
    }
}
