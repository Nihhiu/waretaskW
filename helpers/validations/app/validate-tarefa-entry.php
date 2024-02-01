<!-- Verifica os dados introduzidos e verifica se os mesmos são válidos -->
<?php

function isTarefaValida($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    # Verificar o nome
    if (empty($req['titulo']) || strlen($req['titulo']) < 3 || strlen($req['titulo']) > 100) {
        $errors['nome'] = 'Campo Titulo inválido, necessita no minimo 3 caracteres.';
    }
    
    # Verificar a prioridade
    $prioridadesValidas = ['Baixa', 'Média', 'Alta'];
    if (isset($req['prioridade']) && !in_array($req['prioridade'], $prioridadesValidas)) {
        $errors['prioridade'] = 'Campo Prioridade inválido, deve ser Baixa, Média ou Alta.';
    }

    # Verificar o estado
    $estadosValidos = ['To Do', 'Doing', 'Done', 'Due'];
    if (isset($req['estado']) && !in_array($req['estado'], $estadosValidos)) {
        $errors['estado'] = 'Campo Estado inválido, deve ser Pendente, Em progresso ou Concluída.';
    }

    # Verificar se a data de criação é anterior ao prazo de conclusão
    if (isset($req['dataCriacao']) && isset($req['prazoConclusao'])) {
        $dataCriacao = date('Y-m-d', strtotime(str_replace('/', '-', $req['dataCriacao'])));
        $prazoConclusao = date('Y-m-d', strtotime(str_replace('/', '-', $req['prazoConclusao'])));
        if ($dataCriacao > $prazoConclusao) {
            $errors['prazoConclusao'] = 'Campo Prazo de Conclusão inválido, deve ser uma data após a Data de Criação.';
        }
    }

    if (!getById($req['idUsuarioCreador'])) {
        $errors['idUsuarioCreador'] = 'O correu um erro ao criar a Tarefa, por favor volte a registar no sistema';
        return ['invalid' => $errors];
    }
    

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}