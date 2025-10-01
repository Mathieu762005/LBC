<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Database;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        // On vide la table avant chaque test
        $this->resetTable('users');
        // On insère un utilisateur de test
        $pdo = Database::createInstancePDO();
        $pdo->exec("INSERT INTO users (u_email, u_password, u_username)
VALUES ('test@mail.com', 'pass', 'john')");
    }
    private function resetTable(string $table): void
    {
        $pdo = Database::createInstancePDO();
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        $pdo->exec("DELETE FROM $table");
        $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }
    public function testCheckMailReturnsTrueWhenMailExists()
    {
        // assertTrue → on attend que le résultat soit vrai
        $this->assertTrue(User::checkMail('test@mail.com'));
    }
    public function testCheckMailReturnsFalseWhenMailDoesNotExist()
    {
        // assertFalse → on attend que le résultat soit faux
        $this->assertFalse(User::checkMail('notfound@mail.com'));
    }
    public function testCheckUsernameReturnsTrueWhenUsernameExists()
    {
        $this->assertTrue(User::checkUsername('john'));
    }
    public function testCheckUsernameReturnsFalseWhenUsernameDoesNotExist()
    {
        $this->assertFalse(User::checkUsername('paul'));
    }
}
