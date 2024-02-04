<?php
require_once __DIR__ . '../../db/connection.php';
@require_once __DIR__ . '/../../helpers/session.php';

function createAnexo($anexo)
{   
    $sqlCreate = "INSERT INTO 
    anexo (
        idTarefa, 
        tipoAnexo,    
        nomeAnexo, 
        caminhoAnexo) 
    VALUES (
        :idTarefa, 
        :tipoAnexo,
        :nomeAnexo, 
        :caminhoAnexo
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':idTarefa' => $anexo['idTarefa'],
        ':tipoAnexo' => $anexo['tipoAnexo'],
        ':nomeAnexo' => $anexo['nomeAnexo'],
        ':caminhoAnexo' => $anexo['caminhoAnexo']
    ]);

    if ($success) {
        $anexo['idAnexos'] = $GLOBALS['pdo']->lastInsertId();
        return $anexo;
    }

    return false;
}


function deleteAnexoById($idAnexos)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM anexo WHERE idAnexos = ?;');
    $PDOStatement->bindValue(1, $idAnexos, PDO::PARAM_INT);
    return $PDOStatement->execute();
}
