<?php

@require_once __DIR__ . '/../../helpers/session.php';

if (!administrador()) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/waretaskW/';
    header('Location: ' . $home_url);
}
