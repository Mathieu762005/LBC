<?php
require __DIR__ . '/vendor/autoload.php';
$pdo = App\Models\Database::createInstancePDO();
echo $pdo ? "OK" : "KO";
