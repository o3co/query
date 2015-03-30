<?php
namespace O3Co\Query\Tests\Query;
use O3Co\Query\Query\ExpressionBuilder;
use O3Co\Query\Query\Term;

/**
 * ExpressionBuilderTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class ExpressionBuilderTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * expressionBuilder 
     * 
     * @var mixed
     * @access private
     */
    private $expressionBuilder;

    /**
     * setUp 
     * 
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->expressionBuilder = new ExpressionBuilder();
    }

    /**
     * testAndx 
     * 
     * @access public
     * @return void
     */
    public function testAndx()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->andx($builder->eq('foo', 1), $builder->eq('bar', 'bar'));
        $this->assertInstanceof('O3Co\Query\Query\Term\LogicalExpression', $expr);
        $this->assertEquals(Term\LogicalExpression::TYPE_AND, $expr->getType());
        $this->assertCount(2, $expr->getExpressions());
    }

    /**
     * testOrx 
     * 
     * @access public
     * @return void
     */
    public function testOrx()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->orx($builder->eq('foo', 1), $builder->eq('bar', 'bar'));
        $this->assertInstanceof('O3Co\Query\Query\Term\LogicalExpression', $expr);
        $this->assertEquals(Term\LogicalExpression::TYPE_OR, $expr->getType());
        $this->assertCount(2, $expr->getExpressions());
    }

    public function testNot()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->not($builder->eq('foo', 1));
        $this->assertInstanceof('O3Co\Query\Query\Term\LogicalExpression', $expr);
        $this->assertEquals(Term\LogicalExpression::TYPE_NOT, $expr->getType());
        $this->assertCount(1, $expr->getExpressions());

        try {
            $builder->not(1);
            $this->fail('InvalidArgumentException is not occured.');
        } catch(\InvalidArgumentException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testEq()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->eq('foo', 'foo');
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::EQ, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals('foo', $expr->getValue()->getValue());
    }

    public function testNeq()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->neq('foo', 'foo');
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::NEQ, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals('foo', $expr->getValue()->getValue());
    }

    public function testGt()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->gt('foo', 1);
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::GT, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(1, $expr->getValue()->getValue());
    }

    public function testGte()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->gte('foo', 1);
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::GTE, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(1, $expr->getValue()->getValue());
    }

    public function testLt()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->lt('foo', 1);
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::LT, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(1, $expr->getValue()->getValue());
    }

    public function testLte()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->lte('foo', 1);
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::LTE, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(1, $expr->getValue()->getValue());
    }

    public function testIsNull()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->isNull('foo');
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::EQ, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(null, $expr->getValue()->getValue());
    }

    public function testIsNotNull()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->isNotNull('foo');
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::NEQ, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(null, $expr->getValue()->getValue());
    }

    public function testIsAny()
    {
        $builder = $this->getExpressionBuilder();

        $expr = $builder->isAny('foo');
        $this->assertInstanceof('O3Co\Query\Query\Term\ComparisonExpression', $expr);
        $this->assertEquals(Term\ComparisonExpression::NEQ, $expr->getOperator());
        $this->assertEquals('foo', $expr->getField()->getName());
        $this->assertEquals(null, $expr->getValue()->getValue());
    }

    /**
     * getExpressionBuilder 
     * 
     * @access protected
     * @return void
     */
    protected function getExpressionBuilder()
    {
        return $this->expressionBuilder;
    }
}

