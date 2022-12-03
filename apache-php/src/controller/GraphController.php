<?php

namespace controller;

use model\GraphModel;

class GraphController
{
    static private ?GraphController $state = null;

    private GraphModel $graphModel;

    private function __construct($graphModel)
    {
        $this->graphModel = $graphModel;
    }

    public static function getState($graphModel): ?GraphController
    {
        if (GraphController::$state == null) {
            GraphController::$state = new GraphController($graphModel);
        }

        return GraphController::$state;
    }

    public function printGraphs(): void
    {
        $fixture = $this->graphModel->printGraphs();

        require __DIR__ . '/../view/GraphView.php';
    }
}