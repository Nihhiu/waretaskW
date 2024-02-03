<?php
session_start();
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-tarefa-entry.php';

if (isset($_POST['tarefa_cont'])) {
    if ($_POST['tarefa_cont'] == 'create') {
        criar($_POST);
    }

    if ($_POST['tarefa_cont'] == 'update') {
        update($_POST);
    }

    if ($_POST['tarefa_cont'] == 'delete') {
        delete($_POST);
    }
}

function criar($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $req['idUsuarioCreador'] = usuarioID();
    $data = isTarefaValida($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php' . $params);
    }
    
    # Criar um novo usuário com as informações fornecidas
    $success = createTarefa($data);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Criada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }
}

function update($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $data = isTarefaValida($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php' . $params);
    } 

    # Criar um novo usuário com as informações fornecidas
    $success = updateTarefa($data);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Atualizada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php');
    }
}

function delete($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $data = isTarefaValida($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php' . $params);
    } 

    # Criar um novo usuário com as informações fornecidas
    $success = deleteTarefa($data);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Eliminada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php');
    }
}