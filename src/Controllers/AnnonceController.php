<?php

namespace App\Controllers;

// On importe le modèle Annonce pour pouvoir l'utiliser ici
use App\Models\Annonce;
use finfo;

class AnnonceController
{
    // Méthode qui affiche la page des annonces
    public function annonces(): void
    {
        // On instancie le modèle
        $annonceModel = new Annonce();

        // On récupère toutes les annonces
        $annonces = $annonceModel->getAll();
        // On inclut la vue qui affiche toutes les annonces
        require_once __DIR__ . "/../Views/annonces.php";
    }

    // Méthode qui gère la création d'une annonce
    public function create(): void
    {
        // On vérifie que le formulaire a été soumis en POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On prépare un tableau pour stocker les erreurs éventuelles
            $errors = [];
            $image = null;

            // On récupère l'ID de l'utilisateur connecté depuis la session
            $userId = $_SESSION["user"]["id"] ?? null;

            // Si l'utilisateur n'est pas connecté, on ajoute une erreur
            if (!is_numeric($userId)) {
                $errors['auth'] = "Utilisateur non connecté.";
            } else {
                // On force le type en entier
                $userId = (int) $userId;
            }

            // Vérification du champ "titre"
            if (empty($_POST["titre"])) {
                $errors['titre'] = 'Titre obligatoire';
            }

            // Vérification du champ "description"
            if (empty($_POST["description"])) {
                $errors['description'] = 'Description obligatoire';
            }

            // Vérification du champ "prix"
            if (empty($_POST["prix"])) {
                $errors['prix'] = 'Prix obligatoire';
            }

            // Traitement de l'image envoyée
            $photoPath = '';
            if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
                // On récupère le chemin temporaire et le nom du fichier
                $tmpName = $_FILES['file']['tmp_name'];
                $fileName = basename($_FILES['file']['name']);

                $maxTaille = 8 * 1024 * 1024;
                $mimeOk = [
                    'image/jpeg' => 'jpeg',
                    'image/jpg' => 'jpg',
                    'image/png' => 'png'
                ];

                if ($_FILES['file']['size'] > $maxTaille) {
                    $errors['image'] = 'le fichier est trop volumineux';
                    return;
                }

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);

                if (!array_key_exists($mime, $mimeOk)) {
                    $errors['image'] = 'Type de fichier non autorisé.';
                    return;
                }

                //generer nom unique
                $nomUnique = uniqid() . '_' . $fileName;

                // Dossier de destination pour l'image
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $destination = $uploadDir . $nomUnique;

                // On déplace le fichier vers le dossier final
                if (move_uploaded_file($tmpName, $destination)) {
                    $photoPath = $destination;
                } else {
                    $errors['file'] = "Erreur lors de l'envoi du fichier.";
                }
            } else {
                $errors['file'] = "Image obligatoire.";
            }

            // Si aucune erreur, on peut créer l'annonce
            if (empty($errors)) {
                // On instancie le modèle Annonce
                $annonce = new Annonce();

                // On appelle la méthode createAnnonce avec les données du formulaire
                $success = $annonce->createAnnonce(
                    $_POST["titre"],
                    $_POST["description"],
                    (int) $_POST["prix"],
                    $nomUnique,
                    $userId
                );

                // Si l'insertion a réussi, on redirige vers la liste des annonces
                if ($success) {
                    header('Location: index.php?url=annonces');
                    exit;
                } else {
                    // Sinon, on affiche une erreur serveur
                    $errors['server'] = "Une erreur s'est produite, veuillez réessayer ultérieurement.";
                }
            }
        }

        // On affiche la vue du formulaire de création
        require_once __DIR__ . "/../Views/create.php";
    }

    // Méthode qui affiche les détails d'une annonce (à compléter plus tard)
    public function details($id): void
    {
        $annonceModel = new Annonce;
        $annonces = $annonceModel->getById($id);
        require_once __DIR__ . "/../Views/details.php";
    }
}
