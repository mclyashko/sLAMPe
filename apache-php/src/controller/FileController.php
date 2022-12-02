<?php

namespace controller;

use model\FileModel;

class FileController
{
    static private ?FileController $state = null;

    private FileModel $fileModel;

    private function __construct($fileModel)
    {
        $this->fileModel = $fileModel;
    }

    public static function getState($adminModel): ?FileController
    {
        if (FileController::$state == null) {
            FileController::$state = new FileController($adminModel);
        }

        return FileController::$state;
    }


    public function getFile(): void
    {
        $this->fileModel->getFile();
    }

    public function putFile(): void
    {
        $this->fileModel->putFile();
    }

    public function getFilePage(): void
    {
        require __DIR__ . '/../view/FileView.php';
    }
}
