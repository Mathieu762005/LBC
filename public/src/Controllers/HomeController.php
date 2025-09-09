<?php
namespace App\Controllers;
use App\Models\Database;

class HomeController
{
    public function index() {
        require_once __DIR__ . '/../models/DataBaseModel.php';
        $DataBaseModel = new DataBaseModel();
        $DataBaseModel = $DataBaseModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
}