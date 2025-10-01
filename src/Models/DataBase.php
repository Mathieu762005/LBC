<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    public static function createInstancePDO(): PDO|null
    {
        // Charger le fichier .env
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        // Variables communes
        $db_host = $_ENV['DB_HOST'];
        $db_user = $_ENV['DB_USER'];
        $db_password = $_ENV['DB_PASS'];
        // On choisit la base selon APP_ENV
        $db_name = $_ENV['APP_ENV'] === 'test'
            ? $_ENV['DB_NAME_TEST']
            : $_ENV['DB_NAME_DEV'];
        try {
            $pdo = new PDO(
                "mysql:host=$db_host;dbname=$db_name;charset=utf8",
                $db_user,
                $db_password
            );
            if ($_ENV['APP_ENV'] === 'dev') {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $pdo;
        } catch (PDOException $e) {
            return null;
        }
    }
}
