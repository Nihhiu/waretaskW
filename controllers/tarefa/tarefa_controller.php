<?php
session_start();
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-tarefa-entry.php';

function CriarTarefa($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $data = isTarefaValida($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/secure/tarefa/criar_tarefa.php' . $params);
    } else {
        # Criar um novo usuário com as informações fornecidas
        $tarefa = createTarefa($data);

        header('location: /waretaskW/pages/secure/tarefa/tarefa.php');
    }
}