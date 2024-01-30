<!-- Verifica os dados introduzidos e verifica se os mesmos são válidos -->
<?php

function isSignUpValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    # Verificar o nome
    if (empty($req['nome']) || strlen($req['nome']) < 3 || strlen($req['nome']) > 255) {
        $errors['nome'] = 'Campo Nome inválido, necessita no minimo 3 caracteres.';
    }

    # Verificar o username
    if (empty($req['username']) || strlen($req['username']) < 3 || strlen($req['username']) > 255 || strpos($req['username'], '@') !== false) {
        $errors['username'] = 'Campo Username inválido, necessita no minimo 3 caracteres.';
    }

    # Verificar se o username existe na db
    if (getByUsername($req['username'])) {
        $errors['username'] = 'Username já registado no sistema.';
        return ['invalid' => $errors];
    }

    # Verificar o email
    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Campo Email inválido, necessita ser tipo:  exemplo@exemplo.com';
    }

    # Verificar se o email existe na db
    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email já registado no sistema.';
        return ['invalid' => $errors];
    }

    # Verificar a senha
    if (!empty($req['senha']) && strlen($req['senha']) < 3) {
        $errors['senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
    }

    # Verificar se a confirmação condiz com a senha
    if (!empty($req['confirmar_senha']) && ($req['confirmar_senha']) != $req['senha']) {
        $errors['confirmar_senha'] = 'Campo Confirmar Senha não é igual ao campo Senha.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}