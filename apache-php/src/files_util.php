<?php
require_once 'const.php';

const file = "file";
const file_name = "name";
const tmp_file_name = "tmp_name";
const submit = "submit";

const id = "ID";
const name = "NAME";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        download($collection);
        break;
    case "POST":
        upload($collection);
        break;
    default:
        error();
        break;
}

function download($coll): void
{
    $result = $coll->findOne([id => session_id()]);
    $fileName = $result[name];
    $content = $result[file]->getData();

    header("Content-Transfer-Encoding: binary");
    header('Content-type: '.'pdf');
    header('Expires: 0');
    header("Content-disposition: attachment; filename=".$fileName);
    header('Content-Type:application-x/force-download');
    echo $content;
}

function upload($coll): void
{
    $fileName = $_FILES[file][file_name];
    $tempFileName = $_FILES[file][tmp_file_name];

    if (!isset($_POST[submit]) || empty($fileName)) { error(); return; }
    if (pathinfo(basename($fileName), PATHINFO_EXTENSION) !== 'pdf') { error(); return; }

    $handle = fopen($tempFileName, 'rb');
    $content = fread($handle, filesize($tempFileName));
    fclose($handle);

    $session_id = session_id();
    $coll->deleteMany([id => $session_id]);

    if ($coll->insertOne([
            id => $session_id,
            name => $fileName,
            file => new MongoDB\BSON\Binary($content, MongoDB\BSON\Binary::TYPE_GENERIC)
        ])->getInsertedCount() !== 1)
    { error(); return; }

    $result = $coll->findOne([id => $session_id]);
    echo 'Filename ' . $result[name] . ' session_id ' . $result[id] . ' file_content: ' . $result[file];
}

function error(): void
{
    http_response_code(404);
    echo "FILES ERROR";
}