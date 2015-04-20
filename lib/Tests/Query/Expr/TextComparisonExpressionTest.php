<?php
namespace O3Co\Query\Tests\Query\Expr;

use O3Co\Query\Query\Expr;

class TextComparisonExpressionTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $escaped = Expr\TextComparisonExpression::escapeString('.abc*123_abc');

        $this->assertEquals('\\.abc\\*123_abc', $escaped);
    }
}

