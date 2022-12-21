<?php

namespace app\controllers;

use app\models\Graphs;
use yii\test\Fixture;
use yii\web\Controller;

class GraphsController extends Controller
{
    public function actionGraphs()
    {
        $graphsModel = Graphs::getState();

        $fixture = $graphsModel->printGraphs();

        return $this->render('graphs', [
            'fixture' => $fixture
        ]);
    }
}