<?php

use App\Controllers\AnnonceController;
use App\Controllers\HomeController;
use App\Controllers\UserController;

$url = isset($_GET["url"]) ? $_GET["url"] : null;

switch ($url) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'register':
        $controller = new UserController();
        $controller->register();
        break;

    case 'login':
        $controller = new UserController();
        $controller->login();
        break;

    case 'profil':
        $controller = new UserController();
        $controller->profil();
        break;

    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;

    case 'annonces':
        $controller = new AnnonceController();
        $controller->index();
        break;

    case 'create':
        $controller = new AnnonceController();
        $controller->create();
        break;
}
