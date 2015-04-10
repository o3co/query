<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Push response into ring Server 
GuzzleHttp\Tests\Server::enqueue(array(file_get_contents(__DIR__ . '/../fixtures/response.txt')));

$client = new GuzzleHttp\Client(['base_url' => GuzzleHttp\Tests\Server::$url]);


$client = new O3Co\Query\Bridge\GuzzleHttp\ProxyClient($client);

$qb = new O3Co\Query\Extension\CQL\QueryBuilder($client);

$qb
    ->addWhere($qb->expr()->eq('name', 'foo'))
    ->addWhere($qb->expr()->neq('age', 'hoge'))
    ->addOrder($qb->expr()->asc('age'))
;

GuzzleHttp\Tests\Server::start();

$response = $qb->getQuery()->execute();
$data = $response->json();
var_dump($data);

GuzzleHttp\Tests\Server::stop();
