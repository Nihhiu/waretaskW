<!-- Faz um conjunto de funções sendo elas o Login para entrar na conta,
CheckErrors para verificar se existem erros nos parametros,
doLogin para efetuar a comparação do nome e id
e o Logout para sair da aplicação --> 
<?php
session_start();
require_once __DIR__ . '/../../infra/repositories/usuarioRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-login-password.php';

if (isset($_POST['usuario'])) {
    if ($_POST['usuario'] == 'login') {
        login($_POST['email_or_username'],$_POST['senha']);
    }

    if ($_POST['usuario'] == 'logout') {
        logout();
    }
}

function login($emailusername,$senha)
{   
    $req['email_or_username'] = $emailusername;
    $req['senha'] = $senha;

    $data = ValidacaoLogin($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /waretaskW/pages/public/login.php' . $params);
    } else {
        
        $data = isPasswordValid($req);

        if (isset($data['invalid'])) {
            $_SESSION['errors'] = $data['invalid'];
            $params = '?' . http_build_query($req);
            header('location: /waretaskW/pages/public/login.php' . $params);
        } else {
            doLogin($data);
        } 
    }     
}

function doLogin($data)
{
    $_SESSION['id'] = $data['id'];
    $_SESSION['nome'] = $data['nome'];

    setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
    setcookie("nome", $data['nome'], time() + (60 * 60 * 24 * 30), "/");

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/waretaskW/pages/secure';
    header('Location: ' . $home_url);
}

function logout()
{
    if (isset($_SESSION['id'])) {

        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }
        session_destroy();
    }

    setcookie('id', '', time() - 3600, "/");
    setcookie('name', '', time() - 3600, "/");

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/waretaskW/';
    header('Location: ' . $home_url);
}