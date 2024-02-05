<?php

function ValidacaoLogin($req)
{

    # Verificar se contem um @
    if (strpos($req['email_or_username'], '@') == true) {
        # Caso seja um email
        if (!filter_var($req['email_or_username'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_or_username'] = 'Campo Email inválido, necessita ser tipo:  exemplo@exemplo.com';
            return ['invalid' => $errors];
        }

        if (getByEmail($req['email_or_username']) == false) {
            $errors['email_or_username'] = 'Email não está registado no sistema.';
            return ['invalid' => $errors];
        }
        
    } else {
        # Caso seja um username
        if (empty($req['email_or_username']) || strlen($req['email_or_username']) < 3) {
            $errors['email_or_username'] = 'Campo Username inválido, necessita no minimo 3 caracteres.';
            return ['invalid' => $errors];
        }

        if (getByUsername($req['email_or_username']) == false) {
            $errors['email_or_username'] = 'Username não está registado no sistema.';
            return ['invalid' => $errors];
        }
    }

    # Verificar a senha
    if (empty($req['senha']) || strlen($req['senha']) < 3) {
        $errors['senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
        return ['invalid' => $errors];
    }

    return $req;
}

function isPasswordValid($req)
{
    # Obter os dados do utilizador apartir do email ou  username fornecido
    if (strpos($req['email_or_username'], '@') == true) {
        $user = getByEmail($req['email_or_username']);
        $type = 'Email';
    } else {
        $user = getByUsername($req['email_or_username']);
        $type = 'Username';
    }

    # Verificar se tal utilizador existe
    if ($user == false) {
        $errors['email_or_username'] = "{$type} ou Senha  incorreto(s).";
    } else {
        # Caso exista, verifica se a senha está correta
        if (!password_verify($req['senha'], $user['senha'])) {
            $errors['senha'] = "{$type} ou Senha  incorreto(s).";
        }
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $user;
}
