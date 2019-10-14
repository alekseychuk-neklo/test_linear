<?php

require_once './vendor/autoload.php';
require_once './app/src/func.php';

use Phpml\Dataset\CsvDataset;
use Phpml\Regression\LeastSquares;

$regression = new LeastSquares();

$dataset = new CsvDataset('train.csv', 1, true);


$regression->train($dataset->getSamples(), $dataset->getTargets());
print_r($regression->getCoefficients());
echo "<br>";
print_r('intercept: '.$regression->getIntercept());

$dataset  = new CsvDataset('train_2.csv', 2, true);
echo "<pre>";
//print_r($dataset->getTargets());
echo "</pre>";
$regression = new LeastSquares();
$regression->train($dataset->getSamples(), $dataset->getTargets());
print_r($regression->getCoefficients());
echo "<br>";
print_r('intercept: '.$regression->getIntercept());

