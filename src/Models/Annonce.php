<?php

// On indique que cette classe fait partie du dossier logique "Models"
namespace App\Models;

// On importe la classe Database pour pouvoir se connecter à la base
use App\Models\DataBase;

// On importe les classes PDO pour gérer les requêtes SQL
use PDO;
use PDOException;

// Définition de la classe Annonce
class Annonce
{
    // Propriétés de l'annonce (titre, description, prix, photo, userId)
    public string $titre;
    public string $description;
    public int $prix;
    public string $photo;
    public int $userId; // On précise que c'est un entier

    /**
     * Méthode qui permet de créer une annonce dans la base de données
     * @param string $titre → titre de l'annonce
     * @param string $description → description de l'annonce
     * @param int $prix → prix de l'annonce
     * @param string $photo → chemin de l'image
     * @param int $userId → ID de l'utilisateur qui crée l'annonce
     * @return bool → true si l'insertion a réussi, false sinon
     */
    public function createAnnonce(string $titre, string $description, int $prix, string $photo, int $userId): bool
    {
        try {
            // On crée une connexion à la base de données via notre classe Database
            $pdo = Database::createInstancePDO();

            // Si la connexion échoue, on retourne false
            if (!$pdo) {
                return false;
            }

            // Requête SQL pour insérer une annonce dans la table "annonces"
            $sql = 'INSERT INTO `annonces` (`a_title`, `a_description`, `a_price`, `a_picture`, `u_id`) 
                    VALUES (:titre, :description, :prix, :photo, :userId)';

            // On prépare la requête pour éviter les injections SQL
            $stmt = $pdo->prepare($sql);

            // On lie chaque valeur PHP à son paramètre SQL avec le bon type
            $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

            // On exécute la requête. Si ça marche, on retourne true
            return $stmt->execute();
        } catch (PDOException $e) {
            // Si une erreur SQL se produit, on l'affiche et on retourne false
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
    public function deleteAnnonce($id, $userId)
    {
        $pdo = Database::createInstancePDO();

        // On instancie le modèle
        $annonce = new Annonce();

        $imageName = $annonce->getImageNameById($id);
        $imagePath = __DIR__ . '/../../public/uploads/' . $imageName;

        // Vérifie que le nom de l'image est valide et que ce n'est pas un dossier
        if (!empty($imageName) && is_file($imagePath)) {
            unlink($imagePath);
        }


        $sql = "DELETE
        FROM `annonces`
        WHERE a_id = :id AND u_id = :userId
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $success = $stmt->execute();
        return $success;
    }
    public function updateAnnonce(string $titre, string $description, int $prix, string $photo, int $id): bool
    {
        try {
            $pdo = Database::createInstancePDO();

            if (!$pdo) {
                return false;
            }

            // Requête SQL correcte pour modifier une annonce
            $sql = 'UPDATE `annonces`
                SET `a_title` = :titre,
                    `a_description` = :description,
                    `a_price` = :prix,
                    `a_picture` = :photo
                WHERE `a_id` = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Si une erreur SQL se produit, on l'affiche et on retourne false
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
    public function getAll(): array
    {
        try {
            $pdo = Database::createInstancePDO();
            if (!$pdo) {
                return [];
            }

            $sql = 'SELECT a.*, u.u_username
                    FROM annonces a
                    JOIN users u ON a.u_id = u.u_id
                    ORDER BY a.a_id DESC';

            $stmt = $pdo->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }
    public function getById($id)
    {
        $pdo = Database::createInstancePDO();

        $sql = "SELECT a.*, u.u_username 
                FROM `annonces` a 
                JOIN users u ON a.u_id = u.u_id
                WHERE a.a_id = $id
               ";

        $stmt = $pdo->query($sql);

        return $stmt->fetch($pdo::FETCH_ASSOC);
    }
    public function getByUser($id): array
    {
        $pdo = Database::createInstancePDO();

        $sql = "SELECT *
        FROM `annonces`
        WHERE u_id = :id
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll($pdo::FETCH_ASSOC);
    }
    public function getImageNameById($id)
    {
        $pdo = Database::createInstancePDO();
        $sql = "SELECT a_picture FROM annonces WHERE a_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['a_picture'] : null;
    }
}
