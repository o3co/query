<?php
namespace O3Co\Query\Extension\Http\Tests;
use O3Co\Query\Extension\Http\AbstractParser;

class TestParser extends AbstractParser
{

    public function parseClause($query, $part)
    {
        throw new \Exception('Not Impled');
    }

    public function parseConditionalExpression($query)
    {
        throw new \Exception('Not Impled');
    }
}

