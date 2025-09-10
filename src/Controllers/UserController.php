<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{

    public function register()
    {
        $UserModel = new UserModel();
        require_once __DIR__ . '/../Views/register.php';
    }
    public function login()
    {
        $UserModel = new UserModel();
        require_once __DIR__ . '/../Views/login.php';
    }
    public function profil()
    {
        $UserModel = new UserModel();
        require_once __DIR__ . '/../Views/profil.php';
    }
    public function logout()
    {
        $UserModel = new UserModel();
        require_once __DIR__ . '/../Views/logout.php';
    }
}
