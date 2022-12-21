<?php

namespace app\models;

use Yii;
use yii\base\Model;
use mysqli;
use MongoDB;

const file = "file";
const file_name = "name";
const tmp_file_name = "tmp_name";
const submit = "submit";

const id = "ID";
const name = "NAME";

class Files extends Model
{
    static private ?Files $state = null;

    private \MongoDB\Collection $connection;

    private function __construct($connection)
    {
        $this->connection = $connection;
    }

    public static function getState($connection): ?Files
    {
        if (Files::$state == null) {
            Files::$state = new Files($connection);
        }

        return Files::$state;
    }

    function error(): void
    {
        http_response_code(404);
        echo "FILES ERROR";
    }

    public function putFile(): void
    {
        $fileName = $_FILES[file][file_name];
        $tempFileName = $_FILES[file][tmp_file_name];

        if (!isset($_POST[submit]) || empty($fileName)) { $this->error(); return; }
        if (pathinfo(basename($fileName), PATHINFO_EXTENSION) !== 'pdf') { $this->error(); return; }

        $handle = fopen($tempFileName, 'rb');
        $content = fread($handle, filesize($tempFileName));
        fclose($handle);

        $session_id = session_id();
        $this->connection->deleteMany([id => $session_id]);

        if ($this->connection->insertOne([
                id => $session_id,
                name => $fileName,
                file => new MongoDB\BSON\Binary($content, MongoDB\BSON\Binary::TYPE_GENERIC)
            ])->getInsertedCount() !== 1)
        { $this->error(); return; }

        $result = $this->connection->findOne([id => $session_id]);
        echo 'Filename ' . $result[name] . ' session_id ' . $result[id] . ' file_content: ' . $result[file];
    }

    public function getFile() {
        $result = $this->connection->findOne([id => session_id()]);
        $fileName = $result[name];
        $content = $result[file]->getData();

        Yii::$app->response->headers->set('Content-Transfer-Encoding', "binary");
        Yii::$app->response->headers->set('Content-type', "pdf");
        Yii::$app->response->headers->set('Expires', "0");
        Yii::$app->response->headers->set('Content-disposition', "attachment; filename=" . $fileName);
        Yii::$app->response->headers->set('Content-Type', "application-x/force-download");
        return $content;
    }
}