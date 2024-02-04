<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../../infra/repositories/tarefaRepository.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '../../../../helpers/session.php';

$user = usuario();
$title = '- App';
?>

<head>
<link rel="stylesheet" href="index.css">
</head>

<div class="p-5 mb-2 bg-dark text-white">
  <h1 class="container">Tarefas</h1>
</div>

<main>
    

    <div class="container">
        <section class="py-4">
            <a href="/waretaskW/pages/secure/"><button type="button" class="btn btn-secondary px-5">Back</button></a>
            <a href="/waretaskW/pages/secure/tarefa/criar_tarefa.php"><button type="button" class="btn btn-primary px-5">Criar Tarefa</button></a>
        </section>

        <section>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $_SESSION['success'] . '<br>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                foreach ($_SESSION['errors'] as $error) {
                echo $error . '<br>';
                }
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                unset($_SESSION['errors']);
            }
            ?>
        </section>
        <?php

        $tarefas = getTarefaByUsuarioCriador(usuarioID());

        if (!empty($tarefas)) {
            foreach ($tarefas as $tarefa) {
        ?>  
            <div class="card shadow p-3 mb-5 rounded">
                <div class="row g-2">
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bold "><?= $tarefa['titulo'] ?? null ?></h1>
                        <p class="lead mt-2"><?= $tarefa['estado'] ?? null ?></p>
                        <p class="lead mt-2"><?= $tarefa['prioridade'] ?? null ?> Importância</p>
                        <p class="lead mt-2">Até: <?= $tarefa['prazoConclusao'] ?? null ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="row g-1">
                            <a href='visualizar_tarefa.php?idTarefa=<?= $tarefa['idTarefa'] ?>' class='btn btn-primary mt-2 w-100'>Visualizar Tarefa</a>    
                        </div>
                        
                        <div class="row g-1">
                            <form action="/waretaskW/controllers/tarefa/tarefa_controller.php" method="post">
                                <a href='visualizar_tarefa.php?idTarefa=<?= $tarefa['idTarefa'] ?>'>
                                <button class="btn btn-danger mt-2 w-100" type="submit" name="tarefa_cont" value="delete">Eliminar Tarefa</button>
                                </a>
                            </form>
                        </div>

                        <div class="row g-1">
                            <a href='editar_tarefa.php?idTarefa=<?= $tarefa['idTarefa'] ?>' class='btn btn-warning mt-2 w-100'>Editar Tarefa</a>
                        </div>
                    </div>
                </div>
            </div>
                    
        <?php
            }
        } else {
            header('Location: criar_tarefa.php');
        }
        ?>  
          
    </div>
    
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>