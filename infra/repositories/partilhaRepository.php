<?php
require_once __DIR__ . '../../db/connection.php';
@require_once __DIR__ . '/../../helpers/session.php';

function deletePartilhaByIdUsuario($idUsuarioCreador)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM UsuarioTarefaPartilhado WHERE idUsuarioCreador = ?;');
    $PDOStatement->bindValue(1, $idUsuarioCreador, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function deletePartilhaByIdTarefa($idTarefa)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM UsuarioTarefaPartilhado WHERE idTarefa = ?;');
    $PDOStatement->bindValue(1, $idTarefa, PDO::PARAM_INT);
    return $PDOStatement->execute();
}