<?php

namespace controller;

use model\AdminModel;

class AdminController
{
    static private ?AdminController $state = null;

    private AdminModel $adminModel;

    private function __construct($adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public static function getState($adminModel): ?AdminController
    {
        if (AdminController::$state == null) {
            AdminController::$state = new AdminController($adminModel);
        }

        return AdminController::$state;
    }

    public function getAll(): void
    {
        $users = $this->adminModel->getAll();

        require __DIR__ . '/../view/AdminView.php';
    }

    public function api(): void
    {
        $this->adminModel->api();
    }
}