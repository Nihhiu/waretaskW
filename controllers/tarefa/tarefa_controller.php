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

    if ($_POST['tarefa_cont'] == 'deleteAnexo') {
        deleteAnexo($_POST);
    }
}

function criarTarefa($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $req['idUsuarioCreador'] = usuarioID();
    $data = isTarefaValida($req);
    $anexo = array();
    
    

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php' . $params);
    }
    
    # Criar uma nova tarefa com as informações fornecidas
    $success = create_Tarefa($data);
    
    if (isset($_FILES['anexo'])) {
        $anexoRecebido = $_FILES['anexo'];

        if ($anexoRecebido['error'] == 0) {
            $anexo['idTarefa'] = $success;
            $anexo['tipoAnexo'] = $anexoRecebido['type'];
            $anexo['nomeAnexo'] = $anexoRecebido['name'];

            # Obter o ID do usuário
            $idUsuario = usuarioID();

            # Criar o caminho do diretório com o ID do usuário
            $caminhoDiretorio = '/waretaskW/assets/' . $idUsuario . '/';

            # Verificar se o diretório existe, se não, criar o diretório
            if (!file_exists($caminhoDiretorio)) {
                mkdir($caminhoDiretorio, 0777, true);
            }

            # Atualizar o caminho do anexo para incluir o diretório do usuário
            $anexo['caminhoAnexo'] = $caminhoDiretorio . $anexoRecebido['name'];

    
            # Mover o arquivo para o diretório de anexos
            if (move_uploaded_file($anexoRecebido['tmp_name'], $anexo['caminhoAnexo'])) {
                "O anexo foi carregado com sucesso.";
                criarAnexo($anexo);
            } else {
                $_SESSION['erros'] = "Ocorreu um erro ao carregar o anexo.";
                header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php');
            }
        } else {
            $_SESSION['erros'] = "Ocorreu um erro ao carregar o anexo.";
            header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php');
        }
    } else {
        $_SESSION['success'] = 'Nenhum anexo carregado!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }

    # Verifique se o arquivo foi carregado sem erros
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

        header('location: /waretaskW/pages/secure/tarefa/editar_tarefa.php' . $params);
    } 

    # Criar um novo usuário com as informações fornecidas
    $success = update_Tarefa($data);

    if(!$data['nomeAnexo']) {
        if (isset($_FILES['anexo'])) {
            $anexoRecebido = $_FILES['anexo'];

            if ($anexoRecebido['error'] == 0) {
                $anexo['idTarefa'] = $data['idTarefa'];
                $anexo['tipoAnexo'] = $anexoRecebido['type'];
                $anexo['nomeAnexo'] = $anexoRecebido['name'];

                # Obter o ID do usuário
                $idUsuario = usuarioID();

                # Criar o caminho do diretório com o ID do usuário
                $caminhoDiretorio = '/waretaskW/assets/' . $idUsuario . '/';

                # Verificar se o diretório existe, se não, criar o diretório
                if (!file_exists($caminhoDiretorio)) {
                    mkdir($caminhoDiretorio, 0777, true);
                }

                # Atualizar o caminho do anexo para incluir o diretório do usuário
                $anexo['caminhoAnexo'] = $caminhoDiretorio . $anexoRecebido['name'];

        
                # Mover o arquivo para o diretório de anexos
                if (move_uploaded_file($anexoRecebido['tmp_name'], $anexo['caminhoAnexo'])) {
                    "O anexo foi carregado com sucesso.";
                    criarAnexo($anexo);
                } else {
                    $_SESSION['erros'] = "Ocorreu um erro ao carregar o anexo.";
                    header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php');
                }
            } else {
                $_SESSION['erros'] = "Ocorreu um erro ao carregar o anexo.";
                header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php');
            }
        } else {
            $_SESSION['success'] = 'Nenhum anexo carregado!';
            header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
        }
    }

    

    if ($success) {
        $_SESSION['success'] = 'Tarefa Atualizada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }
}

function deleteTarefa($req)
{   
    # Criar um novo usuário com as informações fornecidas
    $success = deleteTarefaDB($req['idTarefa']);

    if ($success) {
        $_SESSION['success'] = 'Tarefa Eliminada com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php');
    }
}

function criarAnexo($req)
{   
    # Criar um novo anexo com as informações fornecidas
    $success = createAnexo($req);

    if ($success) {
        $_SESSION['success'] = 'Anexo Criado com sucesso!';
        header('location: /waretaskW/pages/secure/anexo/visualizar_lista_anexo.php');
    }
}

function deleteAnexo($req)
{   
    # Eliminar o anexo
    if (file_exists($req['caminhoAnexo'])) {
        unlink($req['caminhoAnexo']);
    }

    # Criar um novo usuário com as informações fornecidas
    $success = deleteAnexoById($req['idAnexos']);

    if ($success) {
        $_SESSION['success'] = 'Anexo Eliminado com sucesso!';
        header('location: /waretaskW/pages/secure/tarefa/editar_tarefa.php?idTarefa=' . $req['idTarefa']);
    }    
}
