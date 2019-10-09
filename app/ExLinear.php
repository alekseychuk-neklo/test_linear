<?php


namespace app\app;


use Regression\LinearRegression;

class ExLinear extends LinearRegression
{

    public function getReultSequense(){
        return $this->resultSequence;
    }
}