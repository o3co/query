<?php
namespace O3Co\Query\SampleClient;

class Collection 
{
    static public function create($class, array $response) 
    {
        $collection = new self();
        if(array_key_exists('total', $response)) {
            $collection->total = $response['total'];
        }

        if(array_key_exists('request_size', $response)) {
            $collection->requestSize = $response['request_size'];
        }

        if(array_key_exists('offset', $response)) {
            $collection->offset = $response['offset'];
        }

        if(array_key_exists('data', $response)) {
            foreach($response['data'] as $idx => $data) {
                $collection->set($idx, $class::fromArray($data));
            }
        }
        return $collection;
    }

    public $total;

    public $requestSize;

    public $offset;

    public $data;

    public function get($key)
    {
        return $this->data[$key];
    }

    public function set($key, Model $value)
    {
        $this->data[$key] = $value;
    }

}

