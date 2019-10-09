<?php

require_once './vendor/autoload.php';
require_once './app/src/func.php';
use app\app\ExLinear;
use mnshankar\LinearRegression\Regression;

$testData = [[245, 1400],[312, 1600], [279, 1700], [308, 1850], [199, 1100]];
$linear = new ExLinear();
$linear->setSourceSequence($testData);
$linear->calculate();
echo "first way ";
var_dump($linear->getEquation());
$chart =[];
$res =$linear->getReultSequense();
$i = 0;
foreach ($testData as $value){
    $chart['labels'][] = $value[0];
    $chart['dataset1'][] = $value[1];
    $chart['dataset2'][] = $res[$i][1];
    $i++;
}


$x_arr = [];
$y_arr = [];
foreach ($testData as $elements){
    $x_arr[] = $elements[0];
    $y_arr[] = $elements[1];
}
echo "second way";
var_dump( linear_regression($x_arr, $y_arr) );

//$reg = new Regression();
//$reg->setX($testData);
//$reg->setY($testData);
//$reg->compute();
//print_r($reg);
include 'app/src/chart.php';


