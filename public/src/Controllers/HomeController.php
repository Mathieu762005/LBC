<?php
namespace App\Controllers;
use App\Models\Database;

class HomeController
{
    public function index() {
        require_once __DIR__ . '/../Models/DataBaseModel.php';
        $DataBaseModel = new DataBaseModel();
        $DataBaseModel = $DataBaseModel->getAll();
        require_once __DIR__ . '/../Views/home.php';
    }
}