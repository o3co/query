<?php
namespace O3Co\Query\Extension\Http\Tests;
use O3Co\Query\Extension\Http\AbstractParser;

class TestParser extends AbstractParser
{

	public function parseClause($query, $part)
	{
		return new ConditionalClause();
	}
}

