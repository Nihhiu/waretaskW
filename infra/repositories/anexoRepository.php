<?php
require_once __DIR__ . '../../db/connection.php';
@require_once __DIR__ . '/../../helpers/session.php';


function deleteAnexoByIdTarefa($idTarefa)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM anexo WHERE idTarefa = ?;');
    $PDOStatement->bindValue(1, $idTarefa, PDO::PARAM_INT);
    return $PDOStatement->execute();
}
