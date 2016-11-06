<?php

namespace ReversePolishCalculator\Operators;

use ReversePolishCalculator\Operator;
use ReversePolishCalculator\Operand;

class SubtractionOperator implements Operator
{

    static function toString(): string {
        return "-";
    }

    public function calculate(Operand $value1, Operand $value2): Operand {
        return new Operand($value1->getValue() - $value2->getValue());
    }

}