<?php

namespace App\Controllers;

use App\Models\DatabaseModel;

class HomeController
{
    public function index()
    {
        $DataBaseModel = new DataBaseModel();
        require_once __DIR__ . '/../Views/home.php';
    }
}
