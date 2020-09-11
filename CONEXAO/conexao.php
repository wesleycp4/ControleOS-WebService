<?php
require "constantes.php";
function conectar()
{
    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $pdo;
}