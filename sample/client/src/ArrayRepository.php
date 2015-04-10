<?php
namespace O3Co\Query\SampleClient;

use O3Co\Query\Extension\Http\Client;
use O3Co\Query\Extension\CQL\QueryBuilder;

class ArrayRepository 
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findOneById($id)
    {
        $qb = new QueryBuilder($this->getClient());
        $qb
            ->addWhere($qb->expr()->eq('id', $id))
            ->setMaxResults(1)
            ->setFirstResult(0)
        ;

        $res = $qb->getQuery()->execute();


        return $res['data'][0];
    }
    
    public function getByNameAndCategory($name, $category)
    {
        $qb = new QueryBuilder($this->getClient());
        $qb
            ->addWhere($qb->expr()->eq('name', $name))
            ->addWhere($qb->expr()->neq('category', $category))
            ->setMaxResults(10)
            ->setFirstResult(0)
        ;

        $res = $qb->getQuery()->execute();

        return $res['data'];
    }
    
    public function getClient()
    {
        return $this->client;
    }
    
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }
}

