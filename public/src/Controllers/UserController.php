<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function register()
    {
        require_once __DIR__ . '/../models/UserModel.php';
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
    public function login()
    {
        require_once __DIR__ . '/../models/UserModel.php';
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
    public function profil()
    {
        require_once __DIR__ . '/../models/UserModel.php';
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
    public function logout()
    {
        require_once __DIR__ . '/../models/UserModel.php';
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../views/home.php';
    }
}
