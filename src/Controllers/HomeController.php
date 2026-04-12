<?php

namespace App\Controllers;

use App\Models\Annonce;

class HomeController
{

    /**
     * Méthode affichant la page d'accueil
     *
     * @return void
     */
    public function index(): void
    {

        $objAnnonce = new Annonce();
        $allAnnonce = $objAnnonce->findAll();

        require_once __DIR__ . "/../Views/home.php";
    }
}
