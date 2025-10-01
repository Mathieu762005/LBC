<?php

use PHPUnit\Framework\TestCase;
use App\Models\Annonce;
use App\Models\Database;

class AnnonceTest extends TestCase
{
    protected function setUp(): void
    {
        // nous supprimons d'abord les annonces, puis les users
        $this->resetTable('annonces');
        $this->resetTable('users');

        // on insère un client dans notre table users
        $pdo = Database::createInstancePDO();

        $pdo->exec("INSERT INTO users (u_email, u_password, u_username)
VALUES ('user@mail.com', 'pass', 'alice')");
    }
    private function resetTable(string $table): void
    {
        $pdo = Database::createInstancePDO();
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        $pdo->exec("DELETE FROM $table");
        $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }
    public function testCreateAnnonceInsertsAnnonce()
    {
        $pdo = Database::createInstancePDO();
        $userId = $pdo->lastInsertId();
        $annonce = new Annonce();
        $result = $annonce->createAnnonce("Vélo route", "Très bon état", 150.0, "test.png", $userId);
        // assertTrue → vérifie que la méthode retourne bien true
        $this->assertTrue($result);
        // assertEquals → vérifie qu’il y a bien 1 annonce en BDD
        $stmt = $pdo->query("SELECT COUNT(*) FROM annonces");
        $this->assertEquals(1, $stmt->fetchColumn());
    }
    public function testFindByIdReturnsAnnonce()
    {
        $pdo = Database::createInstancePDO();
        $userId = $pdo->lastInsertId();
        $annonce = new Annonce();
        $annonce->createAnnonce("PC portable", "Occasion", 500.0, "test.png", $userId);
        $id = $pdo->lastInsertId();
        $result = $annonce->getByUser($id);
        // assertNotFalse → doit retourner un tableau, pas false
        $this->assertNotFalse($result);
        // assertEquals → titre attendu
        $this->assertEquals("PC portable", $result['a_title']);
    }
    public function testFindByUserReturnsAnnonceList()
    {
        $pdo = Database::createInstancePDO();
        $userId = $pdo->lastInsertId();
        $annonce = new Annonce();
        $annonce->createAnnonce("Table", "Bois massif", 100.0, "test.png", $userId);
        $result = $annonce->getByUser($userId);
        // assertIsArray → doit retourner un tableau
        $this->assertIsArray($result);
        // assertCount → le tableau doit contenir 1 élément
        $this->assertCount(1, $result);
    }
}
