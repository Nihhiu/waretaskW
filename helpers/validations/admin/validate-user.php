<?php

function validatedUser($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['nome']) || strlen($req['nome']) < 3 || strlen($req['nome']) > 255) {
        $errors['nome'] = 'Campo Nome inválido, necessita no minimo 3 caracteres.';
    }

    if (empty($req['username']) || strlen($req['username']) < 3 || strlen($req['username']) > 255) {
        $errors['username'] = 'Campo Username inválido, necessita no minimo 3 caracteres.';
    }

    if (getByEmail($req['username'])) {
        $errors['username'] = 'Username já registado no sistema.';
        return ['invalid' => $errors];
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Campo Email inválido, necessita ser tipo:  exemplo@exemplo.com';
    }

    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email já registado no sistema.';
        return ['invalid' => $errors];
    }

    if (!empty($req['senha']) && strlen($req['senha']) < 3) {
        $errors['senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
    }

    if (!empty($req['confirmar_senha']) && ($req['confirmar_senha']) != $req['senha']) {
        $errors['confirmar_senha'] = 'Campo Confirmar Senha não é igual ao campo Senha.';
    }

    $req['administrador'] = !empty($req['administrador']) == 'on' ? true : false;

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}