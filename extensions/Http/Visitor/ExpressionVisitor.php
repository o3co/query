<?php
namespace O3Co\Query\Extension\Http\Visitor;

use O3Co\Query\Query\Visitor\ExpressionVisitor as BaseVisitor;

/**
 * ExpressionVisitor 
 *    Abstract ExpressionVisitor to parse SimpleExpression to Http Based NativeQuery 
 * @uses BaseVisitor
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class ExpressionVisitor extends BaseVisitor 
{
    /**
     * queryComponents 
     * 
     * @var array
     * @access protected
     */
    protected $queryComponents = array();

    /**
     * httpQueryKeys 
     * 
     * @var array key as name of component, value as mapped http query key
     * @access protected
     */
    protected $httpQueryKeys = array(
            'query' => 'q'
        );

    // PHP_QUERY_RFC1738 or PHP_QUERY_RFC3986
    private $encType = PHP_QUERY_RFC1738;

    /**
     * getNativeQuery 
     * 
     * @param array $options 
     * @access public
     * @return void
     */
    public function getNativeQuery(array $options = array(), $asQueryString = true)
    {
        $queryComponents = $this->mapQueryKey($this->queryComponents);

        if($asQueryString) {
            $query = http_build_query($queryComponents, null, null, $this->encType);

            if(isset($options['urlencode']) && !$options['urlencode']) {
                return urldecode($query);
            }
            return $query;
        }

        return $queryComponents;
    }

    /**
     * mapQueryKey 
     * 
     * @param array $queryComponents 
     * @access protected
     * @return void
     */
    protected function mapQueryKey(array $queryComponents)
    {
        $cleaned = array();
        foreach($queryComponents as $key => $value) {
            if(isset($this->httpQueryKeys[$key])) {
                $cleaned[$this->httpQueryKeys[$key]] = $value;
            } else {
                $cleaned[$key] = $value;
            }
        }
        return $cleaned;
    }

    /**
     * setQueryComponent 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function setQueryComponent($key, $value)
    {
        $this->queryComponents[$key] = $value;
    }

    /**
     * getQueryComponent 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function getQueryComponent($key)
    {
        return $this->queryComponents[$key];
    }

    public function hasQueryComponent($key)
    {
        return isset($this->queryComponents[$key]);
    }

    /**
     * unsetQueryComponents 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function removeQueryComponents($key)
    {
        unset($this->queryComponents[$key]);
    }
    
    public function setHttpQueryKey($component, $key)
    {
        $this->httpQueryKeys[$component] = $key;
    }
    
    public function setHttpQueryKeys(array $httpQueryKeys)
    {
        $this->httpQueryKeys = $httpQueryKeys;
        return $this;
    }

    public function getHttpQueryKeys()
    {
        return $this->httpQueryKeys;
    }
}
