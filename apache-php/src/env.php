<?php
// Недостающие элементы устанавливаются в контейнере через composer
require_once '/var/www/vendor/autoload.php';

$mongo_host = 'mongodb';
$mongo_port = '27017';
$mongo_database = 'appMongoDatabase';
$mongo_collection = 'appFileCollection';

// Недостающие элементы устанавливаются в контейнере через composer
$client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

$mongo_db = $client->selectDatabase($mongo_database);
$collection = $mongo_db->selectCollection($mongo_collection);