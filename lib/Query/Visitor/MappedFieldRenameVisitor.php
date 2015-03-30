<?php
namespace O3Co\Query\Query\Visitor;

use O3Co\Query\Query\Part\FieldExpression;
/**
 * MappedFieldRenameVisitor
 * 
 * @uses FieldResolver
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class MappedFieldRenameVisitor extends AbstractFieldRenameVisitor 
{
    /**
     * mappings 
     * 
     * @var mixed
     * @access private
     */
    private $mappings;

    /**
     * __construct 
     * 
     * @param array $mappings 
     * @access public
     * @return void
     */
    public function __construct(array $mappings = array())
    {
        $this->mappings = $mappings;
    }

    /**
     * canResolveFieldName 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function canResolveFieldName($field)
    {
        return isset($this->mappings[$field]);
    }

    /**
     * resolveFieldName 
     * 
     * @param mixed $field 
     * @param array $options 
     * @access public
     * @return void
     */
    public function resolveFieldName($field, array $options = array())
    {
        if(isset($this->mappings[$field])) {
            return $this->mappings[$field];
        }

        throw new \InvalidArgumentException(sprintf('MappedFieldResolver does not support field "%s"', $field));
    }
    
    /**
     * getMappings 
     * 
     * @access public
     * @return void
     */
    public function getMappings()
    {
        return $this->mappings;
    }
    
    /**
     * setMappings 
     * 
     * @param array $mappings 
     * @access public
     * @return void
     */
    public function setMappings(array $mappings)
    {
        $this->mappings = $mappings;
        return $this;
    }
}

