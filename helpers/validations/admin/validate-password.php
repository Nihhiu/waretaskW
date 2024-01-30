<!-- O código checa a validade da password para ver se os parametros são atendidos -->
<?php

function passwordIsValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    if (empty($req['nome']) || strlen($req['nome']) < 3 || strlen($req['nome']) > 255) {
        $errors['nome'] = 'Campo Nome inválido, necessita no minimo 3 caracteres.';
    }

    if (!empty($req['senha']) && strlen($req['senha']) < 3) {
        $errors['senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
    }

    if (!empty($req['confirmar_senha']) && ($req['confirmar_senha']) != $req['senha']) {
        $errors['confirmar_senha'] = 'Campo Confirmar Senha não é igual ao campo Senha.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}