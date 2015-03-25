<?php
namespace O3Co\Query\Extension\Http\Tests;

class AbstractParserTest extends \PHPUnit_Framework_TestCase
{
	public function testPartialQueryKeys()
	{
		$parser = new TestParser(array('condition' => 'q'));

		$this->assertTrue($parser->hasQueryKeyFor('condition'));

		$this->assertEquals('q', $parser->getQueryKeyFor('condition'));

		$parser->removeQueryKeyFor('condition');
		$this->assertFalse($parser->hasQueryKeyFor('condition'));


		$parser->setQueryKeyFor('order', 'o');
		$this->assertTrue($parser->hasQueryKeyFor('order'));
	}
}

