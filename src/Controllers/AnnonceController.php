<?php

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController
{
    public function index()
    {
        require_once __DIR__ . '/../models/AnnonceModel.php';
        $DataBaseModel = new DataBaseModel();
        $DataBaseModel = $DataBaseModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
    public function create()
    {
        require_once __DIR__ . '/../models/AnnonceModel.php';
        $AnnonceModel = new AnnonceModel();
        $AnnonceModel = $AnnonceModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
}
