<?php
namespace O3Co\Query\SampleClient;

use O3Co\Query\Extension\Http\Client;
use O3Co\Query\Extension\CQL\QueryBuilder;

/**
 * ModelRepository 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ModelRepository 
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

        return Model::fromArray($res['data'][0]);
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

        return Collection::create('O3Co\Query\SampleClient\Model', $res);
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

