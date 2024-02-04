<?php
session_start();
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';
require_once __DIR__ . '/../../infra/repositories/anexoRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-tarefa-entry.php';

if (isset($_POST['tarefa_cont'])) {
    if ($_POST['tarefa_cont'] == 'create') {
        criarTarefa($_POST);
    }

    if ($_POST['tarefa_cont'] == 'update') {
        updateTarefa($_POST);
    }

    if ($_POST['tarefa_cont'] == 'delete') {
        deleteTarefa($_POST);
    }
}

function criarTarefa($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $req['idUsuarioCreador'] = usuarioID();
    $data = isTarefaValida($req);
    $anexo = array();
    $anexoRecebido = $_FILES['anexo'];

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php' . $params);
    }
    
    # Criar uma nova tarefa com as informações fornecidas
    $success = create_Tarefa($data);

    # Verifique se o arquivo foi carregado sem erros
    if ($anexoRecebido['error'] == 0) {
        $anexo['idTarefa'] = $success['idTarefa'];
        $anexo['tipoAnexo'] = $anexoRecebido['type'];
        $anexo['nomeAnexo'] = $anexoRecebido['name'];
        $anexo['caminhoAnexo'] = '/waretaskW/assets/' . $anexoRecebido['name'];

        # Mover o arquivo para o diretório de anexos
        if (move_uploaded_file($anexoRecebido['tmp_name'], $anexo['caminhoAnexo'])) {
            echo "O anexo foi carregado com sucesso.";
            criarAnexo($req);
        } else {
            echo "Ocorreu um erro ao carregar o anexo.";
        }
    } else {
        echo "Ocorreu um erro ao carregar o anexo.";
    }

    if ($success) {
        $_SESSION['success'] = 'Tarefa Criada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }
}

function updateTarefa($req)
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
    $success = update_Tarefa($data);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Atualizada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php');
    }
}

function deleteTarefa($req)
{   
    # Criar um novo usuário com as informações fornecidas
    $success = deleteTarefaDB($req);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Eliminada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }
}

function criarAnexo($req)
{   
    # Se retornar inválido, um erro foi retornado
    if (isset($req['invalid'])) {

        $_SESSION['errors'] = $req['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/anexo/criar_anexo.php' . $params);
    }
    
    # Criar um novo anexo com as informações fornecidas
    $success = createAnexo($req);

    if ($success) {
        $_SESSION['success'] = 'Anexo Criado com sucesso!';
        header('location: /waretaskW/pages/secure/anexo/visualizar_lista_anexo.php');
    }
}
