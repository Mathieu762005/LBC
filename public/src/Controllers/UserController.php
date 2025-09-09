<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function register()
    {
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../Views/home.php';
    }
    public function login()
    {
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../Views/home.php';
    }
    public function profil()
    {
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../Views/home.php';
    }
    public function logout()
    {
        $UserModel = new UserModel();
        $UserModel = $UserModel->getAll();
        require_once __DIR__ . '/../Views/home.php';
    }
}
