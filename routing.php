<?php
require __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond('GET', '/calculate', function ($request, $response) {

    $converter = new \ReversePolishCalculator\ExpressionConverter();
    $evaluator = new \ReversePolishCalculator\ExpressionEvaluator();

    try {
        $expression = new \ReversePolishCalculator\Expression($converter->fromString($request->param("exp")));
        $calculation = $evaluator->calculate($expression);

        //TODO: maybe create ExpressionCalculation class with this as a method
        $stringCalcArr = array_map(function ($calcArr) use ($converter): string {
            return $converter->toString($calcArr->getArray());
        }, $calculation);
        $response->json($stringCalcArr);
    } catch (\ReversePolishCalculator\Exceptions\InvalidExpressionArray $e) {
        $response->code(503)->send($e->getMessage());
    } catch (\ReversePolishCalculator\Exceptions\InvalidOperator $e) {
        $response->code(503)->send($e->getMessage());
    }

});

$klein->dispatch();