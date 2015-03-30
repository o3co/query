<?php
namespace O3Co\Query\Tests\Criteria;

use O3Co\Query\Criteria\SimpleParser;
use O3Co\Query\Query\Term;

class SimpleCriteriaParserTest extends \PHPUnit_Framework_TestCase 
{
    public function testParse()
    {
        $parser = new SimpleParser();

        // 
        $query = $parser->parse(
                array('foo' => 'Foo', 'bar' => array('Bar', 'BAR')), 
                array('foo' => 'asc', 'bar' => 'desc'),
                10,
                1
            );

        $this->assertInstanceof('O3Co\Query\Query', $query);
        $statement = $query->getStatement();

        $rootExpr = $statement->getClause('condition')->getFirstExpression();
        $this->assertInstanceof('O3Co\Query\Query\Term\LogicalExpression', $rootExpr);

        $condExprs = $rootExpr->getExpressions();
        $this->assertCount(2, $condExprs);

        foreach($condExprs as $expr) {
            if($expr instanceof O3Co\Query\Query\Term\FieldDeclaredExpression) {
                $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
            } elseif('bar' === $expr) {
                $this->assertInstanceof('O3Co\Query\Query\Term\LogicalExpression', $expr);
            }
        }

        $this->assertCount(2, $query->getStatement()->getClause('order')->getExpressions());
        $exprs = $query->getStatement()->getClause('order')->getExpressions();
        $this->assertTrue($exprs['foo']->isAsc());
        $this->assertTrue($exprs['bar']->isDesc());

        $this->assertEquals(10, $query->getStatement()->getClause('limit')->getValue()->getValue());
        $this->assertEquals(1, $query->getStatement()->getClause('offset')->getValue()->getValue());
    }
}

