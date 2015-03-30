<?php
namespace O3Co\Query\Tests;

use O3Co\Query\Query\Term\Statement;
use O3Co\Query\Query;

class QueryTest extends \PHPUnit_Framework_TestCase 
{
    public function testGetSet()
    {
        $statement = new Statement();
        $persister = new TestPersister(new TestVisitor('test'));
        $query = new Query($statement);

        $this->assertEquals($statement, $query->getStatement());
        $this->assertNull($query->getPersister());

        $query->setPersister($persister);

        $this->assertEquals($persister, $query->getPersister());

    }

    public function testGetNativeQuery()
    {
        $statement = new Statement();
        $persister = new TestPersister(new TestVisitor('test'));

        $query = new Query($statement, $persister);
        $this->assertEquals('test', $query->getNativeQuery());

        $query = new Query($statement);
        try {
            $query->getNativeQuery();
            $this->fail('Expect exception is occured.');
        } catch(\RuntimeException $ex) {
            $this->assertTrue(true);
        }
    }


    public function testExecute()
    {
        $statement = new Statement();
        $persister = new TestPersister(new TestVisitor('test'));
        $persister->results = 'results';
        $query = new Query($statement, $persister);

        $results = $query->execute();
        $this->assertEquals('results', $results);


        $query = new Query($statement);
        try {
            $query->execute();
            $this->fail('Expect exception is occured.');
        } catch(\RuntimeException $ex) {
            $this->assertTrue(true);
        }
    }
}

