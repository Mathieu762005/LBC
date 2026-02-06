<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $testPdo = null;

    public static function createInstancePDO(): PDO|null
    {
        // Charger le fichier .env
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        
        // En mode test, utiliser SQLite si MySQL n'est pas disponible
        if (($_ENV['APP_ENV'] ?? 'dev') === 'test') {
            return self::getTestDatabase();
        }
        
        // Variables communes pour MySQL
        $db_host = $_ENV['DB_HOST'] ?? 'localhost';
        $db_user = $_ENV['DB_USER'] ?? 'root';
        $db_password = $_ENV['DB_PASS'] ?? '';
        $db_name = $_ENV['DB_NAME_DEV'] ?? 'leboncoin';
        
        try {
            $pdo = new PDO(
                "mysql:host=$db_host;dbname=$db_name;charset=utf8",
                $db_user,
                $db_password
            );
            if (($_ENV['APP_ENV'] ?? 'dev') === 'dev') {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $pdo;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    private static function getTestDatabase(): PDO
    {
        // Réutiliser la connexion existante si disponible
        if (self::$testPdo !== null) {
            return self::$testPdo;
        }
        
        // Tenter de se connecter à MySQL d'abord
        try {
            $db_host = $_ENV['DB_HOST'] ?? 'localhost';
            $db_user = $_ENV['DB_USER'] ?? 'root';
            $db_password = $_ENV['DB_PASS'] ?? '';
            $db_name = $_ENV['DB_NAME_TEST'] ?? 'leboncoin_test';
            
            $pdo = new PDO(
                "mysql:host=$db_host;dbname=$db_name;charset=utf8",
                $db_user,
                $db_password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$testPdo = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            // Si MySQL échoue, utiliser SQLite en mémoire
            return self::createSqliteTestDatabase();
        }
    }
    
    private static function createSqliteTestDatabase(): PDO
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Créer les tables nécessaires pour les tests
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                u_id INTEGER PRIMARY KEY AUTOINCREMENT,
                u_email VARCHAR(50) NOT NULL UNIQUE,
                u_password VARCHAR(255) NOT NULL,
                u_username VARCHAR(25) NOT NULL UNIQUE,
                u_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS annonces (
                a_id INTEGER PRIMARY KEY AUTOINCREMENT,
                a_title VARCHAR(255) NOT NULL,
                a_description TEXT NOT NULL,
                a_price DECIMAL(10,2) NOT NULL,
                a_picture VARCHAR(255),
                a_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                u_id INTEGER NOT NULL,
                FOREIGN KEY (u_id) REFERENCES users(u_id)
            )
        ");
        
        self::$testPdo = $pdo;
        return $pdo;
    }
    
    public static function resetTestDatabase(): void
    {
        self::$testPdo = null;
    }
}
