<?php

// On indique que cette classe appartient au dossier logique "Controllers"
namespace App\Controllers;

// On importe la classe User pour pouvoir l'utiliser ici
use App\Models\User;
use App\Models\Annonce;

// Définition de la classe UserController
class UserController
{
    // Méthode qui gère l'inscription d'un utilisateur
    public function register()
    {
        // Si le formulaire est soumis en POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // On prépare un tableau pour stocker les erreurs
            $errors = [];

            // Vérification du champ "username"
            if (isset($_POST["username"])) {
                if (empty($_POST["username"])) {
                    $errors['username'] = 'Pseudo obligatoire';
                } else if (User::checkUsername($_POST["username"])) {
                    $errors['username'] = 'Pseudo déjà utilisé';
                }
            }

            // Vérification du champ "email"
            if (isset($_POST["email"])) {
                if (empty($_POST["email"])) {
                    $errors['email'] = 'Mail obligatoire';
                } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Mail non valide';
                } else if (User::checkMail($_POST["email"])) {
                    $errors['email'] = 'Mail déjà utilisé';
                }
            }

            // Vérification du champ "password"
            if (isset($_POST["password"])) {
                if (empty($_POST["password"])) {
                    $errors['password'] = 'Mot de passe obligatoire';
                } else if (strlen($_POST["password"]) < 8) {
                    $errors['password'] = 'Mot de passe trop court (minimum 8 caractères)';
                }
            }

            // Vérification du champ "confirmPassword"
            if (isset($_POST["confirmPassword"])) {
                if (empty($_POST["confirmPassword"])) {
                    $errors['confirmPassword'] = 'Confirmation du mot de passe obligatoire';
                } else if ($_POST["confirmPassword"] !== $_POST["password"]) {
                    $errors['confirmPassword'] = 'Les mots de passe ne sont pas identiques';
                }
            }

            // Vérification de la case CGU
            if (!isset($_POST["cgu"])) {
                $errors['cgu'] = 'Vous devez accepter les CGU';
            }

            // Si aucune erreur, on crée l'utilisateur
            if (empty($errors)) {
                $objetUser = new User();
                if ($objetUser->createUser($_POST["email"], $_POST["password"], $_POST["username"])) {
                    // Redirection vers une page de succès
                    header('Location: index.php?url=create-success');
                    exit;
                } else {
                    $errors['server'] = "Une erreur s'est produite veuillez réessayer ultérieurement";
                }
            }
        }

        // On affiche la vue du formulaire d'inscription
        require_once __DIR__ . "/../Views/register.php";
    }

    // Méthode qui gère la connexion d'un utilisateur
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];

            // Vérification du champ "email"
            if (isset($_POST["email"])) {
                if (empty($_POST["email"])) {
                    $errors['email'] = 'Mail obligatoire';
                }
            }

            // Vérification du champ "password"
            if (isset($_POST["password"])) {
                if (empty($_POST["password"])) {
                    $errors['password'] = 'Mot de passe obligatoire';
                }
            }

            // Si aucune erreur, on tente la connexion
            if (empty($errors)) {

                // On vérifie que l'email existe dans la base
                if (User::checkMail($_POST["email"])) {

                    // On récupère les infos de l'utilisateur
                    $userInfos = new User();
                    $userInfos->getUserInfosByEmail($_POST["email"]);

                    // On vérifie que le mot de passe est correct
                    if (password_verify($_POST["password"], $userInfos->password)) {

                        // On stocke les infos du user dans la session
                        $_SESSION["user"]["id"] = $userInfos->id;
                        $_SESSION["user"]["email"] = $userInfos->email;
                        $_SESSION["user"]["username"] = $userInfos->username;
                        $_SESSION["user"]["inscription"] = $userInfos->inscription;

                        // Redirection vers la page profil
                        header("Location: index.php?url=profil");
                    } else {
                        $errors['connexion'] = 'Mail ou Mot de passe incorrect';
                    }
                } else {
                    $errors['connexion'] = 'Mail ou Mot de passe incorrect';
                }
            }
        }

        // On affiche la vue du formulaire de connexion
        require_once __DIR__ . "/../Views/login.php";
    }

    // Méthode qui gère la déconnexion
    public function logout()
    {
        // On supprime les données de session
        unset($_SESSION['user']);
        session_destroy();

        // Redirection vers la page de connexion
        header('Location: index.php?url=login');
    }

    // Méthode qui affiche la page profil
    public function profil()
    {
        $id = $_SESSION['user']['id'];
        $annonceModel = new Annonce();
        $annonces = $annonceModel->getByUser($id);
        require_once __DIR__ . "/../Views/profil.php";
    }
}
