<?php
namespace O3Co\Query\Tests\Persister;

use O3Co\Query\Tests\TestPersister;
use O3Co\Query\Tests\TestVisitor;
use O3Co\Query\Query\Visitor\MappedFieldRenameVisitor;
use O3Co\Query\Query;
use O3Co\Query\Query\Part\Statement;

class AbstractPersisterTest extends \PHPUnit_Framework_TestCase 
{
    public function testOuterVisitor()
    {
        $outerVisitor = new TestVisitor('query');
        $outerVisitor2 = new TestVisitor('query2');
        $persister = new TestPersister($outerVisitor);

        $this->assertEquals($outerVisitor, $persister->getOuterVisitor());

        $persister->setOuterVisitor($outerVisitor2);
        $this->assertEquals($outerVisitor2, $persister->getOuterVisitor());
    }

    public function testCustomVisitors()
    {
        $outerVisitor = new TestVisitor('query');
        $persister = new TestPersister($outerVisitor);

        $this->assertInstanceof('O3Co\Query\Query\Visitor\TreeVisitor', $persister->getCustomVisitors());

        $visitor = new MappedFieldRenameVisitor(array('foo' => 'bar'));
        $persister->setCustomVisitors(array($visitor));

        $this->assertContains($visitor, $persister->getCustomVisitors()->getVisitors());
    }
        
    public function testGetNativeQuery()
    {
        $outerVisitor = new TestVisitor('query');
        $persister = new TestPersister($outerVisitor);

        $this->assertEquals('query', $persister->getNativeQuery(new Query(new Statement(), $persister)));
    }

}

