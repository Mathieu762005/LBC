<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\DatabaseModel;

class AnnonceController
{
    public function index()
    {
        $DataBaseModel = new DataBaseModel();
        require_once __DIR__ . '/../views/home.php';
    }
    public function create()
    {
        $AnnonceModel = new AnnonceModel();
        require_once __DIR__ . '/../views/create.php';
    }
    public function annonces()
    {
        $AnnonceModel = new AnnonceModel();
        require_once __DIR__ . '/../views/annonces.php';
    }
}
