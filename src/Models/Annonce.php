<?php

namespace App\Models;

use App\Models\DataBase;

use PDO;
use PDOException;


class Annonce
{
    public string $titre;
    public string $description;
    public int $prix;
    public string $photo;
    public int $userId;

    /**
     * Permet de créer un utilisateur dans la table users
     * @param string $titre
     * @param string $desciption
     * @param int $prix
     * @param string $photo
     * @return bool true si l'insertion a réussi, false en cas d'erreur
     */
    public function createAnnonce(string $titre, string $description, int $prix, string $photo, int $userId): bool
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour insérer une Annonces dans la table Annonces
            $sql = 'INSERT INTO `annonces` (`a_title`, `a_description`, `a_price`, `a_picture`, `u_id`) 
            VALUES (:titre, :description, :prix, :photo, :userId)';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // On associe chaque paramètre nommé de la requête (:email, :password, :username)
            // avec la valeur correspondante en PHP, en précisant leur type (ici string).
            // Grâce aux requêtes préparées, cela empêche toute injection SQL.
            $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            return $stmt->execute();
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}
