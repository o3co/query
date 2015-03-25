<?php
namespace O3Co\Query\Tests\Criteria;

use O3Co\Query\Criteria\SimpleParser;

class SimpleCriteriaParserTest extends \PHPUnit_Framework_TestCase 
{
	public function testParse()
	{
		$parser = new SimpleParser();

		$query = $parser->parse(array('foo' => 'Foo', 'bar' => array('Bar', 'BAR')));

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
	}
}

