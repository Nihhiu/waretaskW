<?php

function ValidacaoPartilha($req)
{

    # Verificar se contem um @
    if (strpos($req['email_or_username'], '@') == true) {
        # Caso seja um email
        if (!filter_var($req['email_or_username'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_or_username'] = 'Campo Email inválido, necessita ser tipo:  exemplo@exemplo.com';
            return ['invalid' => $errors];
        }

        $idUsuario = getByEmail($req['email_or_username']);
        if ($idUsuario == false) {
            $errors['email_or_username'] = 'Email não está registado no sistema.';
            return ['invalid' => $errors];
        }
        
    } else {
        # Caso seja um username
        if (empty($req['email_or_username']) || strlen($req['email_or_username']) < 3) {
            $errors['email_or_username'] = 'Campo Username inválido, necessita no minimo 3 caracteres.';
            return ['invalid' => $errors];
        }

        $idUsuario = getByUsername($req['email_or_username']);
        if ($idUsuario == false) {
            $errors['email_or_username'] = 'Username não está registado no sistema.';
            return ['invalid' => $errors];
        }
    }

    $req['usuarioPartilhado'] = $idUsuario['id'];
    $req['email'] = $idUsuario['email'];

    return $req;
}