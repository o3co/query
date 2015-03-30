<?php
namespace O3Co\Query\Query\Visitor;

/**
 * AbstractFieldRenameVisitor 
 * 
 * @uses AbstractCustomVisitor
 * @uses Visitor
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractFieldRenameVisitor extends AbstractCustomVisitor 
{
    /**
     * visitFieldExpression 
     * 
     * @param Term\FieldExpression $field 
     * @access public
     * @return void
     */
    public function visitFieldExpression(Term\FieldExpression $field)
    {
        if($this->canResolveField($field->getName())) {
            $field->setName($this->resolveField($field->getName()));
        }
    }

    /**
     * canResolveFieldName 
     * 
     * @param mixed $fieldName 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function canResolveFieldName($fieldName);

    /**
     * resolveFieldName 
     * 
     * @param mixed $fieldName 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function resolveFieldName($fieldName);
}

