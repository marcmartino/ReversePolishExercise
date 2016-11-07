<?php
require __DIR__ . '/../vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond('GET', '/calculate', function ($request, $response) {

    $converter = new \ReversePolishCalculator\ExpressionConverter();
    $evaluator = new \ReversePolishCalculator\ExpressionEvaluator();

    try {

        var_dump($request->param("exp"));
        $expression = new \ReversePolishCalculator\Expression($converter->fromString($request->param("exp")));
        //var_dump($expression);
        //$calculation = $evaluator->calculate($expression);

        //$jsonCalculations
        //var_dump($this->sharedData());
        $response->dump($expression);
    } catch (\ReversePolishCalculator\Exceptions\InvalidExpressionArray $e) {
        $response->json(["status" => 505, "message" => $e->getMessage()]);
    }
});

$klein->dispatch();