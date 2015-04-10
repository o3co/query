<?php
namespace O3Co\Query\SampleClient;

class Model extends \StdClass 
{
    /**
     * fromArray 
     * 
     * @param array $data 
     * @static
     * @access public
     * @return void
     */
    static public function fromArray(array $data)
    {
        $model = new self();
        foreach($data as $field => $value) {
            $model->$field = $value;
        }
        return $model;
    }
}

