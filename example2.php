<?php
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_scatter.php');
require_once ('jpgraph/src/jpgraph_line.php');
require_once ('jpgraph/src/jpgraph_utils.inc.php');
require_once 'func.php';
// Create some "fake" regression data
$testData = [[245, 1400],[312, 1600], [279, 1700], [308, 1850], [199, 1100]];
$datay = array();
$datax = array();
$a= 3.2;
$b= 2.5;
foreach ($testData as $elements){
    $datax[] = $elements[0];
    $datay[] = $elements[1];
}
$coef = linear_regression($datax, $datay);

for($x=0; $x < count($testData); $x++) {
    $datax[$x] = $testData[$x][1];
    $datay[$x] = $testData[$x][0]*floatval($coef['m'])+floatval($coef['b']);
}

$lr = new LinearRegression($datax, $datay);
list( $stderr, $corr ) = $lr->GetStat();
list( $xd, $yd ) = $lr->GetY(0,2000);

// Create the graph
$graph = new Graph(300,250);
$graph->SetScale('linlin');

// Setup title
$graph->title->Set("Linear regression");
//$graph->title->SetFont(FF_ARIAL,FS_BOLD,14);

$graph->subtitle->Set('(stderr='.sprintf('%.2f',$stderr).', corr='.sprintf('%.2f',$corr).')');
//$graph->subtitle->SetFont(FF_ARIAL,FS_NORMAL,12);

// make sure that the X-axis is always at the
// bottom at the plot and not just at Y=0 which is
// the default position
$graph->xaxis->SetPos('min');

// Create the scatter plot with some nice colors
$sp1 = new ScatterPlot($datay,$datax);
$sp1->mark->SetType(MARK_FILLEDCIRCLE);
$sp1->mark->SetFillColor("red");
$sp1->SetColor("blue");
$sp1->SetWeight(3);
$sp1->mark->SetWidth(4);

// Create the regression line
$lplot = new LinePlot($yd);
$lplot->SetWeight(2);
$lplot->SetColor('navy');

// Add the pltos to the line
$graph->Add($sp1);
$graph->Add($lplot);

// ... and stroke
$graph->Stroke();
