<?php

namespace controller;
use db\mysqliDb;

class AdminController
{
    static private ?AdminController $state = null;

    private MysqliDb $mysqli;
    private AdminModel $adminModel;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState(): ?AdminController
    {
        if (AdminController::$state == null) {
            AdminController::$state = new AdminController(new MysqliDb());
        }

        return AdminController::$state;
    }

    public function getAll(): void
    {
        $admins = $this->adminModel->getAll();

        require '../view/AdminView.php';
    }

}