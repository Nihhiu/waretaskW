<?php

require_once __DIR__ . '/../../infra/repositories/usuarioRepository.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-user.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-password.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['usuario'])) {
    if ($_POST['usuario'] == 'create') {
        create($_POST);
    }

    if ($_POST['usuario'] == 'update') {
        update($_POST);
    }

    if ($_POST['usuario'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['usuario'] == 'senha') {
        changePassword($_POST);
    }
}

if (isset($_GET['usuario'])) {
    if ($_GET['usuario'] == 'update') {
        $usuario = getById($_GET['id']);
        $usuario['action'] = 'update';
        $params = '?' . http_build_query($usuario);
        header('location: /waretaskW/pages/secure/admin/user.php' . $params);
    }

    if ($_GET['usuario'] == 'delete') {
        $usuario = getById($_GET['id']);
        if ($usuario['administrador']) {
            $_SESSION['errors'] = ['Este Usuario não pode ser eliminado'];
            header('location: /waretaskW/pages/secure/admin/');
            return false;
        }

        $success = delete_usuario($usuario);

        if ($success) {
            $_SESSION['success'] = 'Usuario Eliminado com Sucesso!';
            header('location: /waretaskW/pages/secure/admin/');
        }
    }
}

function create($req)
{
    $data = validarUsuario($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /waretaskW/pages/secure/admin/user.php' . $params);
        return false;
    }

    $success = criarUsuario($data);

    if ($success) {
        $_SESSION['success'] = 'usuario created successfully!';
        header('location: /waretaskW/pages/secure/admin/');
    }
}

function update($req)
{
    $data = validarUsuario($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $_SESSION['action'] = 'update';
        $params = '?' . http_build_query($req);
        header('location: /waretaskW/pages/secure/admin/user.php' . $params);

        return false;
    }

    $success = updateUsuario($data);

    if ($success) {
        $_SESSION['success'] = 'Usuario atualizado com sucesso!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: /waretaskW/pages/secure/admin/user.php' . $params);
    }
}

function updateProfile($req)
{
    $data = validarUsuario($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /waretaskW/pages/secure/user/profile.php' . $params);
    } else {
        $usuario = usuario(); 
        $data['id'] = $usuario['id'];
        $data['administrador'] = $usuario['administrador'];

        $success = updateUsuario($data);

        if ($success) {
            $_SESSION['success'] = 'Perfil atualizado com sucesso!';
            $_SESSION['action'] = 'update';
            $params = '?' . http_build_query($data);
            header('location: /waretaskW/pages/secure/user/profile.php' . $params);
        }
    }
}

function changePassword($req)
{
    $data = passwordIsValid($req);
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /waretaskW/pages/secure/user/password.php' . $params);
    } else {
        $data['id'] = usuarioID();
        $success = updatePassword($data);
        if ($success) {
            $_SESSION['success'] = 'Password successfully changed!';
            header('location: /waretaskW/pages/secure/user/password.php');
        }
    }
}

function delete_usuario($usuario)
{   
    $data = deleteUsuario($usuario['id']);
    return $data;
}
