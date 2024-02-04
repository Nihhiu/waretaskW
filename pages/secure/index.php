<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/repositories/tarefaRepository.php';
@require_once __DIR__ . '/../../helpers/session.php';
include_once __DIR__ . '../../../templates/header.php';

$user = usuario();
$title = '- App';
?>

<head>
<link rel="stylesheet" href="index.css">
</head>

<main>
    <form action="/waretaskW/controllers/auth/login_auth.php" method="post" class="position-absolute top-0 end-0 mt-2 me-2">
        <button class="btn btn-danger btn-lg" type="submit" name="usuario" value="logout">Logout</button>
    </form>
    <div class="row d-flex align-items-center">
        <div class="col-md-12 text-center welcome-section" style="height: 27vh;">
            <div class="d-flex flex-column justify-content-center h-100">
                <h1 class="display-5 fw-bold">Olá
                    <?= $user['nome'] ?? null ?>!
                </h1>
                <p class="lead">Veja que tarefas tem para realizar!</p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Perfil</h2>
                    <a href="/waretaskW/pages/secure/user/profile.php"><button class="btn btn-outline-light px-5"
                            type="button">Alterar</button></a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Tarefa</h2>
                    <a href="/waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php"><button class="btn btn-outline-info px-5" type="button">Visualizar</button></a>
                </div>
            </div>
        </div>    
    </div>

    <div class="container mt-5">
        <div class="text-bg-dark rounded-3" style="height: 40vh;">
        <?php

            $tarefa = getUltimaTarefa($user['id']);
            
            if ($tarefa){
            ?>

                <div class="row g-2 mb-2 justify-content-center ">
                    <div class="col-md-6 h-100 p-5">
                        <h1 class="display-5 fw-bold "><?= $tarefa['titulo'] ?? null ?></h1>
                        <p class="lead mt-5">Tem até <?= $tarefa['prazoConclusao'] ?? null ?> para realizar</p>
                    </div>
                    <div class="col-md-6 h-100 p-5">
                        <p class="lead mt-4">Descrição: <?= $tarefa['descricao'] ?? null ?></p>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row g-1 mb-2">
                    <div class="col-md-12 text-center justify-content-center mt-5">
                        <div class="p-5">
                            <h1 class="display-5 fw-bold">Não tem nenhuma Tarefa a realizar!</h1>
                            <p class="lead">Que tal mudarmos isso?</p>
                            <a href="/waretaskW/pages/secure/tarefa/criar_tarefa.php"><button class="btn btn-outline-light px-5" type="button">Criar Tarefa</button></a>
                        </div>
                    </div>
                </div>
            <?php
            }
        ?>
        </div>
    </div>
        
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>