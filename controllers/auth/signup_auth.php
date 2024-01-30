<?php
session_start();

require_once __DIR__ . '/../../infra/repositories/usuarioRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-sign-up.php';

if (isset($_POST['usuario'])) {
    if ($_POST['usuario'] == 'signup') {
        signUp($_POST);
    }
}

function signUp($req)
{
    # Verificar o preenchimento dos campos obrigatórios
    $data = isSignUpValid($req);

    # Se retornar inválido, um erro foi retornado
    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        
        $params = '?' . http_build_query($req);

        header('location: /waretaskW/pages/public/signup.php' . $params);
    } else {
        # Criar um novo usuário com as informações fornecidas
        $user = createNewUser($data);

        # Criar um cookie de autenticação para o usuário recém criado
        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            
            setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
            setcookie("nome", $data['nome'], time() + (60 * 60 * 24 * 30), "/");
            header('location: /waretaskW/');
        }
    }
}
