<?php
namespace O3Co\Query\Extension\Http\Tests;

class AbstractParserTest extends \PHPUnit_Framework_TestCase
{
	public function testPartialQueryKeys()
	{
		$parser = new TestParser(array('q' => 'condition'));

		$this->assertTrue($parser->isSupportedHttpQueryKey('q'));

		$this->assertEquals('condition', $parser->getClauseForHttpQueryKey('q'));

		$parser->removeHttpQueryKey('q');
		$this->assertFalse($parser->isSupportedHttpQueryKey('q'));


		$parser->setClauseForHttpQueryKey('o', 'order');
		$this->assertTrue($parser->isSupportedHttpQueryKey('o'));
	}
}

