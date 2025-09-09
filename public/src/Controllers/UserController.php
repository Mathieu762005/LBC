<?php
namespace App\Controllers;
use App\Models\User;

class UserController
{
    public function register() {
        require_once __DIR__ . '/../models/UserModel.php';
        $AnnonceModel = new AnnonceModel();
        $AnnonceModel = $AnnonceModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
}