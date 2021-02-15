<?php

try{
    // Connexion à la base
    $pdo = new PDO('mysql:host=mysql;dbname=geekgarage;host=127.0.0.1', 'root', '');
    $pdo->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}
