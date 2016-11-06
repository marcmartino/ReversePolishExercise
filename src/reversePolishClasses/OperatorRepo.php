<?php

namespace ReversePolishCalculator;


use ReversePolishCalculator\Operators\AdditionOperator;
use ReversePolishCalculator\Operators\MultiplicationOperator;
use ReversePolishCalculator\Operators\SubtractionOperator;

//use ReversePolishCalculator\Operators\{MultiplicationOperator, AdditionOperator};

class OperatorRepo
{
    private $supportedOperatorClasses = [AdditionOperator::class, MultiplicationOperator::class, SubtractionOperator::class];

    public  function getOperator(string $operatorLookupString): Operator{
        foreach($this->supportedOperatorClasses as $operatorClass) {
            if ($operatorLookupString == $operatorClass::toString()) {
                return new $operatorClass();
            }
        }
        throw new InvalidOperator($operatorLookupString);
    }
}