<?php

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController
{
    /**
     * Méthode affichant la liste des annonces
     *
     * @return void
     */
    public function index(): void
    {
        $objAnnonce = new Annonce();
        $allAnnonces = $objAnnonce->findAll();
        require_once __DIR__ . "/../Views/annonces.php";
    }

    /**
     * Méthode gérant la création d'une annonce
     *
     * @return void
     */
    public function create(): void
    {

        // on contrôle si une variable de session User est présente
        if (!isset($_SESSION["user"])) {
            header("Location: index.php?url=login");
            exit;
        }

        // traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On crée un tableau d'erreurs vide
            $errors = [];

            // on vérifie que le titre n'est pas vide
            if (empty($_POST['title'])) {
                $errors['title'] = 'Le titre est obligatoire';
            }

            // on vérifie que la description n'est pas vide
            if (empty($_POST['description'])) {
                $errors['description'] = 'La description est obligatoire';
            }

            // on vérifie que le prix n'est pas vide
            if (empty($_POST['price'])) {
                $errors['price'] = 'Un prix est obligatoire';
                // on vérifie que le prix est un nombre positif : attention de bien convertir les virgules en point car is_numeric ne prends pas en compte les virgules
                // nous utilisons donc str_replace()
            } elseif (!is_numeric(str_replace(",", ".", $_POST['price']))) {
                $errors['price'] = 'Le prix doit être un nombre';
            } elseif ($_POST['price'] < 0) {
                $errors['price'] = 'Le prix ne peut pas être inférieur à 0';
            }



            // on controle que la taille du fichier n'a pas fait buggé notre upload à l'aide d'un isset()
            if (!isset($_FILES['picture'])) {
                $errors['picture'] = 'Le fichier est beaucoup trop volumineux';

                // on lance les vérifications uniquement si l'utilisateur à cliquer sur le bouton upload et que le fichier est bien stocké dans un fichier temporaire donc pas error = 0
            } else if ($_FILES['picture']['error'] === 0) {

                // ------------------------------------------------------------------------------------------------
                // nous allons faire un traitement plus long pour la photo car pas mal de paramètres sont à vérifier
                // 
                // 1 : la photo est bien une photo + la photo est au format autorisé
                // 2 : la photo ne dépasse pas une certaine taille
                // ------------------------------------------------------------------------------------------------

                // on créé une variable pour faciliter la manipulation du fichier uploadé via un formulaire qui est stocké dans un ficher temporaire
                $file = $_FILES['picture']['tmp_name'];
                // on stock également son extension dans une variable qui nous servira plus tard
                $fileExtension = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
                // on va créer un tableau des types MIME authorisés
                $mimeOk = ['image/jpeg', 'image/webp', 'image/png'];
                // nous allons définir l'emplacement ou nous allons stocker les images : toutes les images seront dans le répertoire 'uploads'
                $uploadsDir = __DIR__ . "/../../public/uploads/";
                // nous allons vérifier si le dossier existe, car si il est vide, il ne sera pas présent dans le repo lors d'un commit / push
                if (!is_dir($uploadsDir)) {
                    // si non présent, nous allons le créer avec les bons droits (ici 0755, parfait pour du upload de fichier)
                    mkdir($uploadsDir, 0755, true);
                }

                //
                // ETAPE 1 - Nous allons regarder le MIME du fichier pour nous assurer qu'il s'agit bien d'une image
                // Nous allons également regarder si le format est autorisé

                // création d'une ressource Fileinfo pour obtenir le MIME type
                $fileInfos = finfo_open(FILEINFO_MIME_TYPE);

                // on récupère le type MIME qui sera du type 'image/jpeg' ou 'image/png'
                $mime = finfo_file($fileInfos, $file);

                // on regarde dans notre tableau, si le format est autorisé
                if (!in_array($mime, $mimeOk, 1)) {
                    $errors['picture'] = 'Attention, votre image doit être au format : jpeg, png ou webp';

                    //
                    // ETAPE 2 - Nous allons controller la taille de l'image
                    // -> 8 Mo max
                } else if ($_FILES["picture"]["size"] > (8 * 1024 * 1024)) {
                    $errors['picture'] = 'La photo est trop grande 8 Mo max';
                }

                if (empty($errors)) {
                    // si pas d'erreurs dans le contrôle du fichier,
                    // nous allons créer un nom de fichier unique à l'aide de uniqid() et l'extension du fichier que nous avons récupéré.
                    $pictureName = uniqid() . '.' . $fileExtension;
                }
            }


            if (empty($errors)) {

                // on instancie notre objet selon la classe Annonce
                $objAnnonce = new Annonce();

                // nous allons créer notre annonce via un if pour gérer les erreurs
                // ici nous allons voir si $pictureName est présent, si oui on l'utilise, sinon on donne la valeur de null
                // ici on utilise un cast (float) pour transformer la valeur en float plus rapide qu'une fonction native car nous recupérons un string en raison du type=text
                if ($objAnnonce->createAnnonce($_POST['title'], $_POST['description'], (float) $_POST['price'], $pictureName ?? null, $_SESSION['user']['id'])) {
                    //
                    // si l'utilisateur à choisi une photo, nous allons pouvoir uploader l'image dans le dossier uploads
                    if (isset($pictureName)) {
                        move_uploaded_file($file, $uploadsDir . $pictureName);
                    }
                    // je vais créer une variable de session temporaire pour afficher un message sur la page profil : il s'agit d'un tableau avec le message et le type de message bootstrap
                    $_SESSION['message'] = ["message" => "Votre annonce a bien été créée", "message_type" => "success"];

                    header('Location: index.php?url=profil');
                    exit;
                } else {
                    $errors['server'] = "Une erreur s'est produite, veuillez essayer ultérieurement";
                }
            }
        }
        require_once __DIR__ . "/../Views/create.php";
    }

    /**
     * Méthode affichant le détail d'une annonce
     *
     * @param int|null $id
     * @return void
     */
    public function show(?int $id): void
    {
        // on vérifie que l'id est bien un nombre entier et qu'il n'est pas null
        if (is_null($id) || !is_int($id)) {
            header("Location: index.php?url=page404");
            exit;
        }

        // on instancie un objet Annonce
        $objAnnonce = new Annonce();
        $annonce = $objAnnonce->findById($id);

        // si l'annonce n'existe pas, on redirige vers la page 404
        if ($annonce === false) {
            header("Location: index.php?url=page404");
            exit;
        }

        require_once __DIR__ . "/../Views/details.php";
    }

    /**
     * Méthode gérant la suppression d'une annonce
     *
     * @param int|null $id
     * @return void
     */
    public function delete(?int $id): void
    {

        // on contrôle si une variable de session User est présente
        if (!isset($_SESSION["user"])) {
            header("Location: index.php?url=login");
            exit;
        }

        // traitement du delete uniquement si il y a eu un POST = action de la part de l'utilisateur
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on vérifie que l'id est bien un nombre entier et qu'il n'est pas null
            if (is_null($id) || !is_int($id)) {
                header("Location: index.php?url=page404");
                exit;
            }

            // on instancie un objet Annonce
            $objAnnonce = new Annonce();
            $annonce = $objAnnonce->findById($id);

            // si l'annonce n'existe pas, on redirige vers la page 404
            if ($annonce === false) {
                header("Location: index.php?url=page404");
                exit;
            } else {
                // nous allons stocker l'image dans une variable pour la supprimer par la suite
                $annoncePicture = $annonce['a_picture'];
            }

            // nous allons tenter de supprimer l'annonce via un if pour gérer les erreurs
            if ($objAnnonce->deleteAnnonce($id, $_SESSION['user']['id'])) {

                // si l'annonce possède une photo, nous allons la supprimer du dossier uploads
                if (!is_null($annonce['a_picture'])) {
                    $photoPath = __DIR__ . "/../../public/uploads/" . $annonce['a_picture'];
                    // on vérifie que le fichier existe avant de le supprimer
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                // je vais créer une variable de session temporaire pour afficher un message sur la page profil : il s'agit d'un tableau avec le message et le type de message bootstrap
                $_SESSION['message'] = ["message" => "Votre annonce a bien été supprimée", "message_type" => "danger"];
                // je fais ensuite une redirection vers la page profil
                header('Location: index.php?url=profil');
                exit;
            } else {
                // en cas d'erreur lors de la suppression, je crée une variable de session temporaire pour afficher un message sur la page profil : il s'agit d'un tableau avec le message et le type de message bootstrap
                $_SESSION['message'] = ["message" => "Une erreur s'est produite, veuillez réessayer ultérieurement", "message_type" => "warning"];
                header('Location: index.php?url=profil');
                exit;
            }
        }
    }

    /**
     * Méthode gérant la modification d'une annonce
     *
     * @param int|null $id
     * @return void
     */
    public function edit(?int $id): void
    {
        // on contrôle si une variable de session User est présente
        if (!isset($_SESSION["user"])) {
            header("Location: index.php?url=login");
            exit;
        }
        // on vérifie que l'id est bien un nombre entier et qu'il n'est pas null
        if (is_null($id) || !is_int($id)) {
            header("Location: index.php?url=page404");
            exit;
        }
        // on instancie un objet Annonce
        $objAnnonce = new Annonce();
        $annonce = $objAnnonce->findById($id);

        // si l'annonce n'existe pas, on redirige vers la page 404
        if ($annonce === false) {
            header("Location: index.php?url=page404");
            exit;
        }
        // on vérifie que l'utilisateur connecté est bien le propriétaire de l'annonce
        if ($annonce['u_id'] !== $_SESSION['user']['id']) {
            header("Location: index.php?url=profil");
            exit;
        }

        // traitement du formulaire en cas de POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // ///////////////////////////////////////////////////////////////////
            // le controle des champs du formulaire d'édition est similaire à celui de la création d'annonce donc nous allons nous en inspirer
            // ///////////////////////////////////////////////////////////////////

            // On crée un tableau d'erreurs vide
            $errors = [];

            // on vérifie que le titre n'est pas vide
            if (empty($_POST['title'])) {
                $errors['title'] = 'Le titre est obligatoire';
            }

            // on vérifie que la description n'est pas vide
            if (empty($_POST['description'])) {
                $errors['description'] = 'La description est obligatoire';
            }

            // on vérifie que le prix n'est pas vide
            if (empty($_POST['price'])) {
                $errors['price'] = 'Un prix est obligatoire';
                // on vérifie que le prix est un nombre positif : attention de bien convertir les virgules en point car is_numeric ne prends pas en compte les virgules
                // nous utilisons donc str_replace()
            } elseif (!is_numeric(str_replace(",", ".", $_POST['price']))) {
                $errors['price'] = 'Le prix doit être un nombre';
            } elseif ($_POST['price'] < 0) {
                $errors['price'] = 'Le prix ne peut pas être inférieur à 0';
            }

            // nous allons stocker le nom de la photo actuelle dans une variable que nous utiliserons si l'utilisateur ne souhaite pas changer la photo
            // dans ce cas, nous réutiliserons le nom de la photo actuelle
            $pictureName = $annonce['a_picture'];

            // on controle que la taille du fichier n'a pas fait buggé notre upload à l'aide d'un isset()
            if (!isset($_FILES['picture'])) {
                $errors['picture'] = 'Le fichier est beaucoup trop volumineux';

                // on lance les vérifications uniquement si l'utilisateur à cliquer sur le bouton upload et que le fichier est bien stocké dans un fichier temporaire donc pas error = 0
            } else if ($_FILES['picture']['error'] === 0) {

                // ------------------------------------------------------------------------------------------------
                // nous allons faire un traitement plus long pour la photo car pas mal de paramètres sont à vérifier
                // 
                // 1 : la photo est bien une photo + la photo est au format autorisé
                // 2 : la photo ne dépasse pas une certaine taille
                // ------------------------------------------------------------------------------------------------

                // on créé une variable pour faciliter la manipulation du fichier uploadé via un formulaire qui est stocké dans un ficher temporaire
                $file = $_FILES['picture']['tmp_name'];
                // on stock également son extension dans une variable qui nous servira plus tard
                $fileExtension = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
                // on va créer un tableau des types MIME authorisés
                $mimeOk = ['image/jpeg', 'image/webp', 'image/png'];
                // nous allons définir l'emplacement ou nous allons stocker les images : toutes les images seront dans le répertoire 'uploads'
                $uploadsDir = __DIR__ . "/../../public/uploads/";
                // nous allons vérifier si le dossier existe, car si il est vide, il ne sera pas présent dans le repo lors d'un commit / push
                if (!is_dir($uploadsDir)) {
                    // si non présent, nous allons le créer avec les bons droits (ici 0755, parfait pour du upload de fichier)
                    mkdir($uploadsDir, 0755, true);
                }
                // ETAPE 1 - Nous allons regarder le MIME du fichier pour nous assurer qu'il s'agit bien d'une image
                // Nous allons également regarder si le format est autorisé
                // création d'une ressource Fileinfo pour obtenir le MIME type
                $fileInfos = finfo_open(FILEINFO_MIME_TYPE);
                // on récupère le type MIME qui sera du type 'image/jpeg' ou 'image/png'
                $mime = finfo_file($fileInfos, $file);
                // on regarde dans notre tableau, si le format est autorisé
                if (!in_array($mime, $mimeOk, 1)) {
                    $errors['picture'] = 'Attention, votre image doit être au format : jpeg, png ou webp';
                }

                // ETAPE 2 - Nous allons controller la taille de l'image
                // -> 8 Mo max
                if ($_FILES['picture']['size'] > 8 * 1024 * 1024) {
                    $errors['picture'] = 'Votre image ne doit pas dépasser 8 Mo';
                }
                if (empty($errors)) {
                    // si pas d'erreurs dans le contrôle du fichier,
                    // nous allons créer un nom de fichier unique à l'aide de uniqid() et l'extension du fichier que nous avons récupéré.
                    $pictureName = uniqid() . '.' . $fileExtension;
                }
            }

            if (empty($errors)) {
                // ici on utilise un cast (float) pour transformer la valeur en float plus rapide qu'une fonction native car nous recupérons un string en raison du type=text
                if ($objAnnonce->updateAnnonce($id, $_POST['title'], $_POST['description'], (float) $_POST['price'], $pictureName, $_SESSION['user']['id'])) {
                    //
                    // si l'utilisateur à choisi une photo, nous allons pouvoir uploader l'image dans le dossier uploads
                    if (isset($pictureName) && $pictureName !== $annonce['a_picture']) {
                        move_uploaded_file($file, $uploadsDir . $pictureName);
                        // si l'annonce possédait déjà une photo, nous allons supprimer l'ancienne photo du dossier uploads pour ne pas surcharger le serveur de fichiers inutiles
                        if (!is_null($annonce['a_picture'])) {
                            $oldPhotoPath = $uploadsDir . $annonce['a_picture'];
                            // on vérifie que le fichier existe avant de le supprimer
                            if (file_exists($oldPhotoPath)) {
                                unlink($oldPhotoPath);
                            }
                        }
                    }
                    // je vais créer une variable de session temporaire pour afficher un message sur la page profil : il s'agit d'un tableau avec le message et le type de message bootstrap
                    $_SESSION['message'] = ["message" => "Votre annonce a bien été modifiée", "message_type" => "primary"];
                    // nous allons rediriger l'utilisateur vers la page profil
                    header('Location: index.php?url=profil');
                    exit;
                } else {
                    $errors['server'] = "Une erreur s'est produite, veuillez essayer ultérieurement";
                }
            }
        }

        require_once __DIR__ . "/../Views/edit.php";
    }
}
