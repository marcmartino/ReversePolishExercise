<?php

use PHPUnit\Framework\TestCase;
use \ReversePolishCalculator\ExpressionConverter;
use \ReversePolishCalculator\Operand;
use \ReversePolishCalculator\Expression;
use \ReversePolishCalculator\ExpressionEvaluator;
use \ReversePolishCalculator\Operators\AdditionOperator;
use \ReversePolishCalculator\Operators\MultiplicationOperator;
use \ReversePolishCalculator\Exceptions\InvalidExpressionArray;
use \ReversePolishCalculator\Exceptions\InvalidOperator;

class CalculatorTest extends TestCase
{

    public function testExpressionConversion() {
        $textExpStr = "5 1 2 + *";
        $converter = new ExpressionConverter();

        $convertedArr = $converter->fromString($textExpStr);
        $controlExpression = [new Operand(5), new Operand(1), new Operand(2),
            new AdditionOperator(), new MultiplicationOperator()];


        $this->assertEquals($textExpStr, $converter->toString($convertedArr));
        $this->assertEquals($textExpStr, $converter->toString($controlExpression));
    }

    public function testExpressionIteration() {
        $evaluator = new ExpressionEvaluator();
        $testExpression = new Expression([new Operand(5), new Operand(1), new Operand(2),
            new AdditionOperator(), new MultiplicationOperator()]);
        $iteratedExpression = $evaluator->iterateEvaluation($testExpression);
        $expectedExpression = new Expression([new Operand(5), new Operand(3), new MultiplicationOperator()]);

        $this->assertCount(count($expectedExpression->getArray()), $iteratedExpression->getArray());
        $this->assertEquals($expectedExpression->getArray()[0]->toString(), $iteratedExpression->getArray()[0]->toString());
        $this->assertEquals($expectedExpression->getArray()[1]->toString(), $iteratedExpression->getArray()[1]->toString());
        $this->assertEquals($expectedExpression->getArray()[2]->toString(), $iteratedExpression->getArray()[2]->toString());
    }

    public function testFullCalculation() {
        $converter = new ExpressionConverter();
        $evaluator = new ExpressionEvaluator();

        $expression = new Expression($converter->fromString("5 1 2 + 4 * + 3 -"));
        $calculation = $evaluator->calculate($expression);

        $this->assertEquals("14", $converter->toString(array_pop($calculation)->getArray()), "basic calculator function");
    }
}