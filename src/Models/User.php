<?php

// On indique que cette classe appartient au dossier logique "Models"
namespace App\Models;

// On importe la classe Database pour se connecter à la base
use App\Models\DataBase;

// On importe les classes PDO pour exécuter des requêtes SQL
use PDO;
use PDOException;

// Définition de la classe User
class User
{
    // Propriétés du User (correspondent aux colonnes de la table "users")
    public int $id;
    public string $email;
    public string $password;
    public string $username;
    public string $inscription;

    /**
     * Méthode pour créer un nouvel utilisateur dans la base
     */
    public function createUser(string $email, string $password, string $username): bool
    {
        try {
            // Connexion à la base via notre classe Database
            $pdo = Database::createInstancePDO();

            // Si la connexion échoue, on retourne false
            if (!$pdo) {
                return false;
            }

            // Requête SQL pour insérer un nouvel utilisateur
            $sql = 'INSERT INTO `users` (`u_email`, `u_password`, `u_username`) VALUES (:email, :password , :username)';

            // Préparation de la requête pour éviter les injections SQL
            $stmt = $pdo->prepare($sql);

            // On lie les valeurs aux paramètres SQL
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR); // On hash le mot de passe
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);

            // On exécute la requête et on retourne le résultat
            return $stmt->execute();
        } catch (PDOException $e) {
            // En cas d'erreur SQL, on affiche le message et on retourne false
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Méthode pour vérifier si un email existe déjà dans la base
     */
    public static function checkMail(string $email): bool
    {
        try {
            $pdo = Database::createInstancePDO();

            if (!$pdo) {
                return false;
            }

            // Requête pour vérifier si l'email existe
            $sql = 'SELECT 1 FROM `users` WHERE `u_email` = :email LIMIT 1';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Si on trouve une ligne, l'email existe
            $result = $stmt->fetchColumn();
            return $result !== false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Méthode pour vérifier si un nom d'utilisateur existe déjà
     */
    public static function checkUsername(string $username): bool
    {
        try {
            $pdo = Database::createInstancePDO();

            if (!$pdo) {
                return false;
            }

            // Requête pour vérifier si le username existe
            $sql = 'SELECT 1 FROM `users` WHERE `u_username` = :username LIMIT 1';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Si on trouve une ligne, le username existe
            $result = $stmt->fetchColumn();
            return $result !== false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Méthode pour récupérer les infos d'un utilisateur via son email
     */
    public function getUserInfosByEmail(string $email): bool
    {
        try {
            $pdo = Database::createInstancePDO();

            if (!$pdo) {
                return false;
            }

            // Requête pour récupérer toutes les infos du user
            $sql = "SELECT * FROM `users` WHERE `u_email` = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // On récupère les données sous forme d'objet
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            // On hydrate notre objet User avec les données récupérées
            $this->id = $user->u_id;
            $this->email = $user->u_email;
            $this->password = $user->u_password;
            $this->username = $user->u_username;
            $this->inscription = $user->u_inscription;

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
