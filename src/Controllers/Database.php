<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";        // ton hôte
    private $port = "8889";             // ton port (MAMP par défaut)
    private $db_name = "leboncoin";     // nom de ta base
    private $username = "root";         // utilisateur MySQL
    private $password = "root";         // mot de passe MySQL
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );

            // Configure PDO pour afficher les erreurs
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Erreur de connexion : " . $exception->getMessage());
        }

        return $this->conn;
    }
}
