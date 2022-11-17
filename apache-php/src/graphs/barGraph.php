<?php

// Недостающие элементы устанавливаются в контейнере через composer
require_once '/var/www/vendor/autoload.php';
require_once 'dataLoader.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_bar(): void
{
    $graph = new Graph\Graph(500, 500, 'auto');
    $graph->title->Set("NYA vs NO NYA");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->SetShadow(true);

    $raw_data = raw_data();

    $mapped = array();
    foreach ($raw_data as $d) {
        $description = $d->description;
        if (str_contains($description, 'nya')) {
            $mapped['nya'] += 1;
        } else {
            $mapped['no nya'] += 1;
        }
    }

    $labels = array_map('strval', array_keys($mapped));
    for($i = 0; $i < count($labels); $i++){
        $labels[$i] = $labels[$i] . ' descs';
    }
    $values = array_values($mapped);

    $graph->SetScale('textlin');
    $graph->xaxis->SetTickLabels($labels);

    $plot = new Plot\BarPlot($values);

    $graph->Add($plot);

    $graph->Stroke('bar.png');
}