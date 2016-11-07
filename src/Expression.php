<?php

namespace ReversePolishCalculator;

use \ReversePolishCalculator\Exceptions\InvalidExpressionArray;
use \ReversePolishCalculator\Operator;
use \ReversePolishCalculator\Operand;

class Expression
{
    private $expressionArray;

    public function __construct(array $expressionArray) {
        if ($this->isArrayValid($expressionArray)) {
            $this->expressionArray = $expressionArray;
        } else {
            throw new InvalidExpressionArray("Cannot create expression from given array");
        }
    }

    private function isArrayValid(array $testExpression) {
        foreach($testExpression as $expressionItem) {
            if (!(is_a($expressionItem, Operator::class) || is_a($expressionItem, Operand::class))) {
                return false;
            }
        }
        return true;
    }

    public function getArray(): array {
        return $this->expressionArray;
    }
}