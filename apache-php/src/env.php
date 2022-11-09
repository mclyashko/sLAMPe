<?php
// Недостающие элементы устанавливаются в контейнере через composer
require_once '../vendor/autoload.php';

$mongo_host = 'mongodb';
$mongo_port = '27017';

// Недостающие элементы устанавливаются в контейнере через composer
$client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");