<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';
include_once __DIR__ . '../../../templates/header.php';

$user = usuario();
$title = '- App';
?>

<head>
<link rel="stylesheet" href="index.css">
</head>

<main>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center welcome-section"> 
            <h1 class="display-5 fw-bold">Olá
                <?= $user['nome'] ?? null ?>!
            </h1>
            <p class="lead">Pronto para o dia?</p>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-bg-dark rounded-3">
                <h2>Profile</h2>
                <a href="/waretaskW/pages/secure/user/profile.php"><button class="btn btn-outline-light px-5"
                        type="button">Change</button></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Tarefa</h2>
                <!-- Adiciona o botão "Visualizar Tarefas" -->
                <a href="/waretaskW/pages/secure/tarefa/tarefa.php"><button class="btn btn-outline-info ms-2" type="button">Visualizar Tarefas</button></a>
            </div>
        </div>

        <?php
        if (isAuthenticated() && $user['administrador']) {
            echo '<div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h2>Admin</h2>
                        <a href="/waretaskW/pages/secure/admin/"><button class="btn btn-outline-success" type="button">Admin</button></a>
                    </div>
                </div>';
        }
        ?>
    </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>