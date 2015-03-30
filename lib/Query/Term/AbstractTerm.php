<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;
use O3Co\Query\Query\Visitor;

/**
 * AbstractTerm 
 * 
 * @abstract
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
abstract class AbstractTerm implements Term
{
    /**
     * __get 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function __get($name)
    {
        return $this->{'get' . ucfirst($name)}();
    }

    /**
     * __set 
     * 
     * @param mixed $name 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function __set($name, $value)
    {
        return $this->{'set' . ucfirst($name)}($value);
    }

    /**
     * dispatch 
     * 
     * @param Visitor $visit 
     * @access public
     * @return void
     */
    public function dispatch(Visitor $visitor)
    {
        $class = substr(strrchr(get_class($this), "\\"), 1); 
        $method = 'visit' . ucfirst($class);

        // 
        if(method_exists($visitor, $method)) {
            return $visitor->$method($this);
        }
        
        // not supported
        throw new \RuntimeException(sprintf('%s::%s is not implemented to dispatch.', get_class($visitor), $method));
    }
}

