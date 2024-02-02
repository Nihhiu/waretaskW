<?php
require_once __DIR__ . '../../db/connection.php';
@require_once __DIR__ . '/../../helpers/session.php';

# Abreviação da Tarefa --> Para a página visualização de todas as tarefas

function getTarefaByUsuarioCriador($idUsuarioCreador)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT t.idTarefa, t.titulo , t.estado FROM tarefa t 
    WHERE t.idUsuarioCreador = :idUsuarioCreador 
    UNION 
    SELECT t.idTarefa, t.titulo , t.estado FROM tarefa t 
    JOIN UsuarioTarefaPartilhado utp ON t.idTarefa = utp.idTarefa 
    WHERE utp.usuarioPartilhado = :idUsuarioCreador 
    ORDER BY t.prazoConclusao;');
    $PDOStatement->bindValue(':idUsuarioCreador', $idUsuarioCreador, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch(PDO::FETCH_ASSOC);
}

function getTarefaPartilhada($idUsuarioCreador)
{
    $sql = 'SELECT t.idTarefa, t.titulo, t.estado FROM tarefa t 
            JOIN UsuarioTarefaPartilhado utp ON t.idTarefa = utp.idTarefa 
            WHERE utp.usuarioPartilhado = :idUsuarioCreador';
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->bindValue(':idUsuarioCreador', $idUsuarioCreador, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
}

# Visualuzação Completa da Tarefa --> Para a página individual de cada tarefa

function getTarefaById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM tarefa WHERE idTarefa = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM tarefa;');
    $users = [];
    while ($listaDeusers = $PDOStatement->fetch()) {
        $users[] = $listaDeusers;
    }
    return $users;
}

# CRUD

function createTarefa($tarefa)
{
    $sqlCreate = "INSERT INTO 
    tarefa (
        titulo, 
        descricao, 
        prioridade, 
        dataCriacao, 
        prazoConclusao,
        estado,
        favorito,
        tarefa,
        idUsuarioCriador) 
    VALUES (
        :titulo, 
        :descricao, 
        :prioridade, 
        :dataCriacao, 
        :prazoConclusao,
        :estado,
        :favorito,
        :tarefa,
        :idUsuarioCreador
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':titulo' => $tarefa['titulo'], 
        ':descricao' => $tarefa['descricao'], 
        ':prioridade' => $tarefa['prioridade'], 
        ':dataCriacao' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $tarefa['dataCriacao']))),
        ':prazoConclusao' => isset($tarefa['prazoConclusao']) ? date('Y-m-d', strtotime(str_replace('/', '-', $tarefa['prazoConclusao']))) : null,
        ':estado' => $tarefa['estado'],
        ':favorito' => isset($tarefa['favorito']) ? 1 : 0,
        ':tarefa' => ($tarefa['tarefa']),
        ':idUsuarioCreador' => ($tarefa['idUsuarioCreador']),
    ]);

    if ($success) {
        $tarefa['idTarefa'] = $GLOBALS['pdo']->lastInsertId();
        return true;
    }
    return false;
}

function updateTarefa($tarefa)
{
    $sqlUpdate = "UPDATE  
    tarefa SET
        titulo = :titulo, 
        descricao = :descricao,
        prioridade = :prioridade,
        dataCriacao = :dataCriacao,
        prazoConclusao = :prazoConclusao,
        estado = :estado,
        favorito = :favorito,
        tarefa = :tarefa,
        idUsuarioCreador = :idUsuarioCreador
    WHERE idTarefa = :idTarefa;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':idTarefa' => $tarefa['idTarefa'],
        ':titulo' => $tarefa['titulo'], 
        ':descricao' => $tarefa['descricao'], 
        ':prioridade' => $tarefa['prioridade'], 
        ':dataCriacao' => date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $tarefa['dataCriacao']))),
        ':prazoConclusao' => isset($tarefa['prazoConclusao']) ? date('Y-m-d', strtotime(str_replace('/', '-', $tarefa['prazoConclusao']))) : null,
        ':estado' => $tarefa['estado'],
        ':favorito' => isset($tarefa['favorito']) ? 1 : 0,
        ':tarefa' => ($tarefa['tarefa']),
        ':idUsuarioCreador' => ($tarefa['idUsuarioCreador']),
    ]);
}


function deleteTarefa($idTarefa)
{
    deletePartilhaByIdTarefa($idTarefa);
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM tarefa WHERE idTarefa = ?;');
    $PDOStatement->bindValue(1, $idTarefa, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function deleteTarefaByIdUsuario($idUsuarioCreador)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM tarefa WHERE idUsuarioCreador = ?;');
    $PDOStatement->bindValue(1, $idUsuarioCreador, PDO::PARAM_INT);
    return $PDOStatement->execute();
}