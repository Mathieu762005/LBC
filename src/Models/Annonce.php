<?php

namespace App\Models;

use App\Models\Database;

use PDO;
use PDOException;

class Annonce
{
    public int $id;
    public string $title;
    public string $description;
    public float $price;
    public string $publication;
    public int $user_id;

    /**
     * Permet de récupérer toutes les annonces dans la table annonces
     * @return array|false tableau des annonces ou false en cas d'erreur
     */
    public function findAll(): array|false
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour récupérer toutes les annonces dans la table annonces
            $sql = 'SELECT * FROM `annonces` ORDER BY `a_publication` DESC';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            if ($stmt->execute()) {
                // on récupère toutes les lignes retournées par la requête dans un tableau associatif à l'aide de fetchAll(PDO::FETCH_ASSOC)
                // chaque ligne de la table correspond à un tableau associatif
                // on retourne le tableau des annonces
                $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $annonces;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }



    /**
     * Permet de récupérer toutes les annonces dans la table annonces
     * @return array|false tableau des annonces ou false en cas d'erreur
     */
    public function findById($id): array|false
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour récupérer toutes les annonces dans la table annonces
            $sql = 'SELECT `a_id`, `a_title`, `a_description`, `a_picture`, `a_price`, `a_publication`, `u_username`, `annonces`.`u_id` FROM `annonces` INNER JOIN `users` ON `annonces`.`u_id` = `users`.`u_id` WHERE `a_id` = :id ORDER BY `a_publication` DESC';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // on associe chaque paramètre nommé de la requête (:id)
            // avec la valeur correspondante en PHP, en précisant leur type (ici int).
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            if ($stmt->execute()) {
                // on récupère toutes les lignes retournées par la requête dans un tableau associatif à l'aide de fetchAll(PDO::FETCH_ASSOC)
                // chaque ligne de la table correspond à un tableau associatif
                // on retourne le tableau des annonces
                $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
                return $annonce;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }


    /**
     * Permet de récupérer toutes les annonces dans la table annonces selon l'id de l'utilisateur
     * @return array|false tableau des annonces ou false en cas d'erreur
     */
    public function findByUser($userId): array|false
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour récupérer toutes les annonces dans la table annonces
            $sql = 'SELECT * FROM `annonces` WHERE `u_id` = :userId ORDER BY `a_publication` DESC';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // on associe chaque paramètre nommé de la requête (:userId)
            // avec la valeur correspondante en PHP, en précisant leur type (ici int).
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            if ($stmt->execute()) {
                // on récupère toutes les lignes retournées par la requête dans un tableau associatif à l'aide de fetchAll(PDO::FETCH_ASSOC)
                // chaque ligne de la table correspond à un tableau associatif
                // on retourne le tableau des annonces
                $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $annonces;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Permet de créer une annonce dans la table annonces
     * @param string $title
     * @param string $description
     * @param float $price
     * @param string|null $picture
     * @param string $publication
     * @param int $userId
     * @return bool true si l'insertion a réussi, false en cas d'erreur
     */
    public function createAnnonce(string $title, string $description, float $price, ?string $picture, int $userId): bool
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour insérer une annonce dans la table annonces
            $sql = 'INSERT INTO `annonces` (`a_title`, `a_description`, `a_price`, `a_picture`, `u_id`) VALUES (:title, :description , :price, :picture, :userId)';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // on associe chaque paramètre nommé de la requête (:title, :description, :price, :user_id)
            // avec la valeur correspondante en PHP, en précisant leur type (ici string).
            // grâce aux requêtes préparées, cela empêche toute injection SQL.
            // nous utilisons également htmlspecialchar pour rendre tout code html innofensif
            $stmt->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
            $stmt->bindValue(':description', htmlspecialchars($description), PDO::PARAM_STR);
            $stmt->bindValue(':price', $price, PDO::PARAM_STR);
            $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            return $stmt->execute();
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }


    /**
     * Permet de supprimer une annonce dans la table annonces selon son id
     * @param int $id
     * @return bool true si la suppression a réussi, false en cas d'erreur
     */
    public function deleteAnnonce(int $id, int $userId): bool
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();
            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }
            // requête SQL pour supprimer une annonce dans la table annonces
            $sql = 'DELETE FROM `annonces` WHERE `a_id` = :id AND `u_id` = :userId';
            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);
            // on associe chaque paramètre nommé de la requête (:id, :userId
            // avec la valeur correspondante en PHP, en précisant leur type (ici int).
            // grâce aux requêtes préparées, cela empêche toute injection SQL.
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera                                
            return $stmt->execute();
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Permet de modifier une annonce dans la table annonces selon son id
     * @param int $id
     * @param string $title
     * @param string $description
     * @param float $price
     * @param string|null $picture
     * @param int $userId
     * @return bool true si la modification a réussi, false en cas d'erreur
     */
    public function updateAnnonce(int $id, string $title, string $description, float $price, ?string $picture, int $userId): bool
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // test si la connexion est ok
            if (!$pdo) {
                // pas de connexion, on return false
                return false;
            }

            // requête SQL pour modifier une annonce dans la table annonces
            $sql = 'UPDATE `annonces` SET `a_title` = :title, `a_description` = :description, `a_price` = :price, `a_picture` = :picture WHERE `a_id` = :id AND `u_id` = :userId';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // on associe chaque paramètre nommé de la requête (:id, :title, :description, :price, :picture, :userId)
            // avec la valeur correspondante en PHP, en précisant leur type (ici string).
            // grâce aux requêtes préparées, cela empêche toute injection SQL.
            // nous utilisons également htmlspecialchar pour rendre tout code html innofensif
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
            $stmt->bindValue(':description', htmlspecialchars($description), PDO::PARAM_STR);
            $stmt->bindValue(':price', $price, PDO::PARAM_STR);
            $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

            // On exécute la requête préparée. La méthode renvoie true si tout s’est bien passé,
            // false sinon. 
            // NB : Avec PDO configuré en mode ERRMODE_EXCEPTION, une erreur déclenchera une exception.
            return $stmt->execute();
        } catch (PDOException $e) {
            // test unitaire pour connaitre la raison de l'echec
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}
