<?php
require_once __DIR__ . '../../db/connection.php';

function createUser($user)
{
    $user['senha'] = password_hash($user['senha'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    usuario (
        nome, 
        username, 
        email, 
        administrador, 
        senha) 
    VALUES (
        :nome, 
        :username, 
        :email,
        :administrador, 
        :senha
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':nome' => $user['nome'],
        ':username' => $user['username'],
        ':email' => $user['email'],
        ':administrador' => $user['administrador'],
        ':senha' => $user['senha']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM usuario WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM usuario WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByUsername($username)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM usuario WHERE username = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $username);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}


function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM usuario;');
    $users = [];
    while ($listaDeusers = $PDOStatement->fetch()) {
        $users[] = $listaDeusers;
    }
    return $users;
}

function updateUser($user)
{
    if (isset($user['senha']) && !empty($user['senha'])) {
        $user['senha'] = password_hash($user['senha'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        usuario SET
            nome = :nome, 
            username = :username, 
            email = :email, 
            administrador = :administrador, 
            senha = :senha
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':nome' => $user['nome'],
            ':username' => $user['username'],
            ':email' => $user['email'],
            ':administrador' => $user['administrador'],
            ':senha' => $user['senha']
        ]);
    }

    $sqlUpdate = "UPDATE  
    usuario SET
        nome = :nome, 
        username = :username, 
        email = :email, 
        administrador = :administrador
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id'],
        ':nome' => $user['nome'],
        ':username' => $user['username'],
        ':email' => $user['email'],
        ':administrador' => $user['administrador'],
    ]);
}

function updatePassword($user)
{
    if (isset($user['senha']) && !empty($user['senha'])) {
        $user['senha'] = password_hash($user['senha'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        usuario SET
            nome = :nome, 
            senha = :senha
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':nome' => $user['nome'],
            ':senha' => $user['senha']
        ]);
    }
}

function deleteUser($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM usuario WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function createNewUser($user)
{
    $user['senha'] = password_hash($user['senha'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    usuario (
        nome, 
        username,    
        email, 
        senha) 
    VALUES (
        :nome, 
        :username,
        :email, 
        :senha
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':nome' => $user['nome'],
        ':username' => $user['username'],
        ':email' => $user['email'],
        ':senha' => $user['senha']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}
