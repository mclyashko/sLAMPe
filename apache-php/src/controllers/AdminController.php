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
use mysqli;
use yii\filters\auth\HttpBasicAuth;

const dbHost = 'mysql', dbUser = 'user', dbPass = 'password', dbName = 'appDB';


class AdminController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAdmin()
    {
        $adminModel = Admin::getState(
            new mysqli(dbHost, dbUser, dbPass, dbName)
        );

        $users = $adminModel->getAll();

        return $this->render('admin', [
            'users' => $users,
        ]);
    }

    public function actionUpdate()
    {
        $weatherModel = Site::getState(
            new mysqli(dbHost, dbUser, dbPass, dbName)
        );

        $weatherModel->updateWeather();

        $adminModel = Admin::getState(
            new mysqli(dbHost, dbUser, dbPass, dbName)
        );

        $users = $adminModel->getAll();

        return $this->render('admin', [
            'users' => $users,
        ]);
    }

    public function actionApi()
    {
        $adminModel = Admin::getState(
            new mysqli(dbHost, dbUser, dbPass, dbName)
        );

        return $adminModel->api();
    }
}