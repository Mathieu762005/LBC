<?php

// On indique que cette classe appartient au dossier logique "Controllers"
namespace App\Controllers;

// Définition de la classe HomeController
class HomeController {

    /**
     * Méthode qui affiche la page d'accueil
     */
    public function index(){
        // On inclut la vue "home.php" qui contient le HTML de la page d'accueil
        require_once __DIR__ . "/../Views/home.php";
    }
}
