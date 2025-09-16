<?php

namespace App\Controllers;

class AnnonceController
{
    public function annonces() {
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function create() {
        require_once __DIR__ . "/../Views/create.php";
    }
}
