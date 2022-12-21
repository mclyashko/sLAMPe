<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Site;
use app\models\Admin;
use app\models\Files;
use mysqli;
use yii\filters\auth\HttpBasicAuth;
use MongoDB;

require_once '/var/www/vendor/autoload.php';

class FilesController extends Controller
{
    public function actionFiles()
    {
        return $this->render('files');
    }

    public function actionGet()
    {
        $mongo_host = 'mongodb';
        $mongo_port = '27017';
        $mongo_database = 'appMongoDatabase';
        $mongo_collection = 'appFileCollection';
        // Недостающие элементы устанавливаются в контейнере через composer
        $client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

        $mongo_db = $client->selectDatabase($mongo_database);
        $collection = $mongo_db->selectCollection($mongo_collection);

        $filesModel = Files::getState(
            $collection
        );

        return $filesModel->getFile();
    }

    public function actionPut()
    {
        $mongo_host = 'mongodb';
        $mongo_port = '27017';
        $mongo_database = 'appMongoDatabase';
        $mongo_collection = 'appFileCollection';
        // Недостающие элементы устанавливаются в контейнере через composer
        $client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

        $mongo_db = $client->selectDatabase($mongo_database);
        $collection = $mongo_db->selectCollection($mongo_collection);

        $filesModel = Files::getState(
            $collection
        );

        $filesModel->putFile();
    }

}