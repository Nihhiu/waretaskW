<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '/../../helpers/session.php';

function createPartilha($partilha)
{   
    $sqlCreate = "INSERT INTO 
    UsuarioTarefaPartilhado (
        idTarefa, 
        usuarioPartilhado) 
    VALUES (
        :idTarefa, 
        :usuarioPartilhado
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':idTarefa' => $partilha['idTarefa'],
        ':usuarioPartilhado' => $partilha['usuarioPartilhado']
    ]);

    if ($success) {
        return $partilha;
    }

    return false;
}

function getPartilhaByIdTarefa($idTarefa)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT UsuarioTarefaPartilhado.*, usuario.email FROM UsuarioTarefaPartilhado JOIN usuario ON UsuarioTarefaPartilhado.usuarioPartilhado = usuario.id WHERE UsuarioTarefaPartilhado.idTarefa = ?;');
    $PDOStatement->bindValue(1, $idTarefa, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
}

function deletePartilhaDB($partilha)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM UsuarioTarefaPartilhado WHERE idTarefa = ? AND usuarioPartilhado = ?;');
    $PDOStatement->bindValue(1, $partilha['idTarefa'], PDO::PARAM_INT);
    $PDOStatement->bindValue(2, $partilha['usuarioPartilhado'], PDO::PARAM_INT);
    return $PDOStatement->execute();
}
