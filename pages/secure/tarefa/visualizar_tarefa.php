<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Visualizar Tarefa';
$user = usuario();
$tarefa = getTarefaById($_GET['idTarefa']);

?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1><?php echo $modoVisualizacao ? 'Visualizar Tarefa' : 'Editar Tarefa'; ?></h1>
</div>
<main>
  <section class="py-4">
    <a href="/waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
  </section>
  <section>
    <!-- Formulário de criação ou visualização de tarefa -->
    <form action="/waretaskW/controllers/criar_tarefa.php" method="post" class="form-control py-3">
      <!-- Adicione os campos necessários para a tarefa -->
      <div class="col-md-6 h-100 p-5">
        <h1 class="display-5 fw-bold"><?= $titulo ?? null ?></h1>
        <p class="lead mt-5">Tem até <?= $prazoConclusao ?? null ?> para realizar</p>
        <p class="lead mt-4">Descrição: <?= $descricao ?? null ?></p>
        <p class="lead">Prioridade: <?= $prioridade ?? null ?></p>
        <p class="lead">Data de Criação: <?= $dataCriacao ?? null ?></p>
        <p class="lead">Estado: <?= $estado ?? null ?></p>
        <p class="lead">Favorito: <?= $favorito ?? null ?></p>
        <p class="lead">ID do Usuário Criador: <?= $idUsuarioCreador ?? null ?></p>
      </div>

      <!-- Botão de envio (somente se estiver no modo de edição) -->
      <?php if (!$modoVisualizacao): ?>
      <div class="d-grid col-4 mx-auto">
        <button class="w-100 btn btn-lg btn-success mb-2" type="submit">Salvar Edições</button>
      </div>
      <?php endif; ?>
    </form>
  </section>
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>