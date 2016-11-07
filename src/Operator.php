<?php

namespace ReversePolishCalculator;


interface Operator
{
    public function calculate(Operand $value1, Operand $value2): Operand;
    static function toString() : string;
}