<?php

namespace db;

class MongoiDb {
    private string $mongo_host = 'mongodb';
    private string $mongo_port = '27017';
    private string $mongo_database = 'appMongoDatabase';
    private string $mongo_collection = 'appFileCollection';
    private ?\MongoDB\Collection $connection = null;

    public function getConnection(): \MongoDB\Collection
    {
        if ($this->connection == null) {
            $client = new MongoDB\Client("mongodb://{$this->mongo_host}:{$this->mongo_port}");
            $mongo_db = $client->selectDatabase($this->mongo_database);
            $this->connection = $mongo_db->selectCollection($this->mongo_collection);
        }

        return $this->connection;
    }
}