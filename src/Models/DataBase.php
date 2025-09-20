<?php 

// On indique que cette classe fait partie du dossier logique "Models"
namespace App\Models;

// On importe les classes PDO et PDOException qui sont des outils PHP pour gérer les bases de données
use PDO;
use PDOException;

// Définition de la classe Database
class Database {

    /**
     * Méthode statique qui permet de créer une connexion à la base de données avec PDO
     * @return PDO|null → retourne une instance PDO si la connexion réussit, sinon null
     */
    public static function createInstancePDO(): ?PDO
    {
        // Paramètres de connexion à la base de données
        // Ces valeurs sont souvent définies dans un fichier .env ou dans Docker
        $db_host = 'db'; // nom du serveur (ici "db" car utilisé dans Docker)
        $db_name = 'leboncoin'; // nom de la base de données
        $db_user = 'root'; // nom d'utilisateur
        $db_password = 'root'; // mot de passe

        try {
            // On crée une nouvelle instance PDO avec les paramètres ci-dessus
            $pdo = new PDO(
                'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8',
                $db_user,
                $db_password
            );

            // On active l'affichage des erreurs SQL (utile en développement)
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // On retourne l'objet PDO pour pouvoir l'utiliser dans les autres classes
            return $pdo;
        } catch (PDOException $e) {
            // Si la connexion échoue, on retourne null
            // En développement, on peut afficher l'erreur pour comprendre le problème
            // echo 'Erreur : ' . $e->getMessage();
            return null;
        }
    }
}
