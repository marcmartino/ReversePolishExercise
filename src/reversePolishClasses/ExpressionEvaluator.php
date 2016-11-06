<?php

namespace ReversePolishCalculator;

use ReversePolishCalculator\Exceptions\InvalidExpressionArray;

class ExpressionEvaluator
{
    public function isComputationComplete(Expression $expression) {
        return boolval(count($expression->getArray()) == 1);
    }

    public function iterateEvaluation(Expression $expression): Expression {
        if (!$this->isComputationComplete($expression)) {
            $nextOperatorPos = $this->findFirstOperator($expression);
            $expToEval = $this->getExpressionAroundOperator($expression, $nextOperatorPos);
            return $this->updateExpressionEvaluation($expression, $this->runOperator($expToEval), $nextOperatorPos);
        }
        throw new InvalidExpressionArray($expression);
    }

    public function calculate(Expression $expression): array {
        $calculationSteps = [$expression];
        while(!$this->isComputationComplete($expression)) {

            $expression = $this->iterateEvaluation($expression);
            array_push($calculationSteps, $expression);
        }
        return $calculationSteps;
    }

    private function getExpressionAroundOperator(Expression $expression, int $nextOperatorPos): Expression {
        return new Expression(array_slice($expression->getArray(), $nextOperatorPos - 2, 3));
    }

    private function findFirstOperator(Expression $expression): int {
        $expressionArray = $expression->getArray();
        for ($expIndex = 2; $expIndex < count($expressionArray); $expIndex++) {
            if (is_a($expressionArray[$expIndex], Operator::class)) {
                return $expIndex;
            }
        }
        throw new InvalidExpressionArray($expressionArray);
    }

    private function updateExpressionEvaluation(Expression $expression, Operand $operand, int $operatorPos): Expression {
        $expArr = $expression->getArray();
        array_splice($expArr, $operatorPos - 2, 3, [$operand]);

        return new Expression($expArr);
    }

    private function runOperator(Expression $expression): Operand {
        $expArr = $expression->getArray();
        if (count($expArr) == 3 && is_a($expArr[2], Operator::class)) {
            return $expArr[2]->calculate($expArr[0], $expArr[1]);
        }
        throw new InvalidExpressionArray($expression);
    }


}