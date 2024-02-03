<!-- O código checa a validade da password para ver se os parametros são atendidos -->
<?php

function passwordIsValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    $user = usuario();

    if (!password_verify($req['senha_atual'], $user['senha'])) {
        $errors['senha_atual'] = "Verificação da Senha incorreto.";
    }

    if (!empty($req['nova_senha']) && strlen($req['nova_senha']) < 3) {
        $errors['nova_senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
    }

    if (!empty($req['confirmar_senha']) && ($req['confirmar_senha']) != $req['nova_senha']) {
        $errors['confirmar_senha'] = 'Campo Confirmar Senha não é igual ao campo Senha.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}