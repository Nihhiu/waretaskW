<?php

function isLoginValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    # Verificar se contem um @
    if (strpos($req['email_or_username'], '@') !== false) {
        # Caso contenha verifica-se se é um email válido
        if (!filter_var($req['email_or_username'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_or_username'] = 'Campo Email inválido, necessita ser tipo:  exemplo@exemplo.com';
        }
    } else {
        # Caso não contenha, verifica-se se é um username válido
        if (empty($req['email_or_username']) || strlen($req['email_or_username']) < 3) {
            $errors['email_or_username'] = 'Campo Username inválido, necessita no minimo 3 caracteres.';
        }
    }

    # Verificar a senha
    if (empty($req['senha']) || strlen($req['senha']) < 3) {
        $errors['senha'] = 'Campo Senha inválido, necessita no minimo 3 caracteres.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

function isPasswordValid($req)
{
    # Se  o usuário não estiver logado
    if (!isset($_SESSION['id'])) {
        # Obter os dados do utilizador apartir do email ou  username fornecido
        if (strpos($req['email_or_username'], '@') !== false) {
            $user = getByEmail($req['email_or_username']);
            $type = 'Email';
        } else {
            $user = getByUsername($req['email_or_username']);
            $type = 'Username';
        }

        # Verificar se tal utilizador existe
        if (!$user) {
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
}
