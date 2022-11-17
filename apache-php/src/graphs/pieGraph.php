<?php

// Недостающие элементы устанавливаются в контейнере через composer
require_once '/var/www/vendor/autoload.php';
require_once 'dataLoader.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_pie(): void
{
    $graph = new Graph\PieGraph(500, 500);
    $graph->title->Set("DESCRIPTION LENGTH");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->SetBox(true);

    $raw_data = raw_data();

    $mapped = array();
    foreach ($raw_data as $d) {
        $mapped[strlen($d->description)] += 1;
    }

    $labels = array_map('strval', array_keys($mapped));
    for($i = 0; $i < count($labels); $i++){
        $labels[$i] = $labels[$i] . 'symbs';
    }
    $values = array_values($mapped);

    $plot = new Plot\PiePlot($values);
    $plot->ShowBorder();
    $plot->SetColor('red');
    $plot->SetLabels($labels);

    $graph->Add($plot);

    $graph->Stroke("pie.png");
}