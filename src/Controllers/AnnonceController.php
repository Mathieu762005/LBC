<?php

namespace App\Controllers;

class AnnonceController
{
    public function annonces(): void
    {
        require_once __DIR__ . "/../Views/annonces.php";
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // je créé un tableau d'erreurs vide car pas d'erreur
            $errors = [];

            if (isset($_POST["titre"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["titre"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['titre'] = 'Titre obligatoire';
                }
            }

            if (isset($_POST["description"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["description"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['description'] = 'Description obligatoire';
                }
            }

            if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
                // Récupère le nom temporaire et le nom original
                $tmpName = $_FILES['file']['tmp_name'];
                $fileName = basename($_FILES['file']['name']);

                // Chemin du dossier où on veut enregistrer l'image
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $destination = $uploadDir . $fileName;

                // Déplace le fichier vers le dossier final
                move_uploaded_file($tmpName, $destination);
            }
        }
        require_once __DIR__ . "/../Views/create.php";
    }
    public function show(?int $id): void
    {
        require_once __DIR__ . "/../Views/details.php";
    }
}
