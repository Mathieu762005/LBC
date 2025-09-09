<?php

namespace App\Models;

class UserModel
{
    public function getAll(): array
    {
        $json = file_get_contents(__DIR__ . "/../data/données.php");
        $data = json_decode($json, true);
        return $data["annonces"];
    }
}
