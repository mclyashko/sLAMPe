<?php

// Недостающие элементы устанавливаются в контейнере через composer
require_once '/var/www/vendor/autoload.php';
require_once 'dataLoader.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_scatter(): void
{
    $graph = new Graph\Graph(500,500);
    $graph->title->Set("Description length forward to the name length");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->SetShadow(true);

    $raw_data = raw_data();

    $mapped = array();
    foreach ($raw_data as $d) {
        $mapped['description length'][] = strlen($d->description);
        $mapped['name length'][] = strlen($d->name);
    }

    $labels = array_keys($mapped['description length']);
    $values = array_values($mapped['name length']);

    $graph->SetScale("linlin");

    $plot = new Plot\ScatterPlot($values, $labels);

    $graph->Add($plot);

    $graph->Stroke('scatter.png');
}
