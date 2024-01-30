<!-- Esta função inicia a sessão ao verificar o user e o id -->
<?php
session_start();
require_once __DIR__ . '/../infra/repositories/usuarioRepository.php';

# Retorna o ID do usuário atual, se tiver logado
function isAuthenticated()
{
    return isset($_SESSION['id']) ? true : false;
}

# Obtem os dados do utilizador logado
function usuario()
{
    if (isAuthenticated()) {
        return getById($_SESSION['id']);
    } else {
        return false;
    }
}

# Obtem o ID do utilizador atual
function usuarioID()
{
    return  $_SESSION['id'];
}

# Verifica se o utilizador é administrador
function administrador()
{
    $user = usuario();
    return $user['administrador'] ? true : false;
}
?>