<!-- Conecção á base de dados -->
<?php

try {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'waretask';

    // conecte-se ao servidor MySQL sem selecionar um banco de dados
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';port=3308;charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // criar a db
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$DATABASE_NAME}");

    // selecionar a db
    $pdo->exec("use {$DATABASE_NAME}");
} catch (PDOException $e) {
    echo "Ups! O marcelo é o maior";
    echo $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

