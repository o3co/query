<?php
namespace O3Co\Query\Bridge\MuseTerpsichore;

use O3Co\Query\Extension\Http\Client as BaseClient;

class Client extends BaseClient 
{
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function lookup(array $queries = array())
    {
                
    }
}

