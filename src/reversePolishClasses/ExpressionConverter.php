<?php

namespace ReversePolishCalculator;

use ReversePolishCalculator\Operand;
use ReversePolishCalculator\OperatorRepo;

class ExpressionConverter
{
    private $operatorRepo;

    public function __construct() {
        $this->operatorRepo = new OperatorRepo();
    }

    public function fromString(string $strExpression): array {
        return array_map(function ($strValue) {
            //TODO: maybe move operand validity check elsewhere
            if (is_numeric($strValue)) {
                return new Operand(floatval($strValue));
            }
            return $this->operatorRepo->getOperator($strValue);
        }, explode(" ", $strExpression));
    }

    public function toString(array $arrExpression): string {
        $arrExpression = array_map(function ($expressionItem) {
            return $expressionItem->toString();
        }, $arrExpression);
        return join(" ", $arrExpression);
    }
}