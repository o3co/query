<?php
namespace O3Co\Query\Query\Visitor\FieldResolver;

/**
 * MappedFieldResolver 
 * 
 * @uses FieldResolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MappedFieldResolver implements FieldResolver 
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
     * canResolveField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function canResolveField($field)
    {
        return isset($this->mappings[$field]);
    }

    /**
     * resolveField 
     * 
     * @param mixed $field 
     * @param array $options 
     * @access public
     * @return void
     */
    public function resolveField($field, array $options = array())
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

