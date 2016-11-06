<?php

namespace ReversePolishCalculator;


class Operand
{
    private $value;

    function __construct(float $num) {
        if (isset($num)) {
            $this->setValue($num);
        }
    }

    public function getValue(): float {
        return $this->value;
    }
    public function setValue(float $num): void {
        $this->value = $num;
    }

    public function toString(): string {
        return (string)$this->value;
    }
}