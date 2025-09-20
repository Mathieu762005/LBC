<?php
namespace App\Controllers;

use App\Models\Annonce;

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
            $userId = $_SESSION["user"]["id"] ?? null;

            if (!is_numeric($userId)) {
                $errors['auth'] = "Utilisateur non connecté.";
            }

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

            if (isset($_POST["prix"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["prix"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['prix'] = 'prix obligatoire';
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

            if (empty($errors)) {

                // j'instancie mon objet selon la classe User
                $objetAnnonce = new Annonce();
                // je vais créer mon User selon la méthode createUser() et j'essaie de créer mon User
                if ($objetAnnonce->createAnnonce($_POST["titre"], $_POST["description"], $_POST["prix"], $_FILES["file"]["tmp_name"], $userId)) {
                    header('Location: index.php?url=annonces');
                    exit;
                } else {
                    $errors['server'] = "Une erreur s'est produite veuillez rééssayer ultèrieurement";
                }
            }
        }
        require_once __DIR__ . "/../Views/create.php";
    }
    public function show(?int $id): void
    {
        require_once __DIR__ . "/../Views/details.php";
    }
}
