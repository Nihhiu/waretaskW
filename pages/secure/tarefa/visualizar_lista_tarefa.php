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
  <h1>Tarefas</h1>
</div>

<main>
    <section class="py-4">
        <a href="/waretaskW/pages/secure/user/profile.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
    </section>

    <?php

    $tarefas = getTarefaByUsuarioCriador($user['id']);

    if (is_array($tarefas)) {
        foreach ($tarefas as $tarefa) {
    ?>
                <div class="input-group mb-3">
                    <span class="input-group-text">Título</span>
                    <a href="visualizar_tarefa.php?id=<?php echo $tarefa['idTarefa']; ?>">
                        <input type="text" class="form-control" name="titulo" value="<?php echo $tarefa['titulo']; ?>" required>
                    </a>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Estado</span>
                    <input type="text" class="form-control" name="estado" value="<?php echo $tarefa['estado']; ?>" required>
                </div>
    <?php
        }
    } else {
        header('Location: criar_tarefa.php');
    }
    ?>
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>