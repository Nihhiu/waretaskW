<?php
require_once __DIR__ . '/../../infra/repositories/partilhaRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-partilha-entry.php';

if (isset($_POST['partilha'])) {

    if ($_POST['partilha'] == 'create') {
        criarPartilha($_POST);
    }

    if ($_POST['partilha'] == 'delete') {
        deletePartilha($_POST);
    }
}

function criarPartilha($req)
{   
    # Verificar o preenchimento dos campos obrigatórios
    $data = ValidacaoPartilha($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php?idTarefa=' . $req['idTarefa'] . $params);
    } else {
        # Criar um nova partilha com as informações fornecidas
        $success = createPartilha($data);

        if ($success) {
            $_SESSION['success'] = 'Partilhado com usuario ' . $data['email'];
            header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php?idTarefa=' . $req['idTarefa']);
        }
    }
        
}

function deletePartilha($req)
{
    # Criar um novo usuário com as informações fornecidas
    $success = deletePartilhaDB($req);

    if ($success) {
        $_SESSION['success'] = 'Removido a partilha do usuario' . $req['email'];
        header('location: /waretaskW/pages/secure/tarefa/visualizar_tarefa.php?idTarefa=' . $req['idTarefa']);
    }    
}