<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Push response into ring Server 
$mock = new GuzzleHttp\Subscriber\Mock(array(
        file_get_contents(__DIR__ . '/../fixtures/response.findOneBy.txt'),
        file_get_contents(__DIR__ . '/../fixtures/response.findBy.txt'),
    ));
$client = new GuzzleHttp\Client();
$client->getEmitter()->attach($mock);
$client->getEmitter()->attach(new GuzzleHttp\Subscriber\Log\LogSubscriber(null, GuzzleHttp\Subscriber\Log\Formatter::DEBUG));

$client = new O3Co\Query\Bridge\GuzzleHttp\ProxyClient($client);

$repository = new O3Co\Query\SampleClient\ModelRepository($client);
$data = $repository->findOneById(1);
//var_dump($data);

$data = $repository->getByNameAndCategory('name', 'category');
var_dump($data);
