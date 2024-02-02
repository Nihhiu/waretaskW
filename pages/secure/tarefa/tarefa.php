<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Visualizar Tarefa';
$user = usuario();

// Inicializa os valores dos campos
$modoVisualizacao = true; // Altere para false se for permitir edição
$titulo = '';
$descricao = '';
$prioridade = '';
$dataCriacao = '';
$prazoConclusao = '';
$estado = '';
$favorito = '';
$tarefa = '';
$idUsuarioCreador = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se o formulário foi enviado, processa os dados
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $prioridade = $_POST['prioridade'] ?? '';
    $dataCriacao = $_POST['dataCriacao'] ?? '';
    $prazoConclusao = $_POST['prazoConclusao'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $favorito = $_POST['favorito'] ?? '';
    $tarefa = $_POST['tarefa'] ?? '';
    $idUsuarioCreador = $_POST['idUsuarioCreador'] ?? '';
} 

?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1><?php echo $modoVisualizacao ? 'Visualizar Tarefa' : 'Editar Tarefa'; ?></h1>
</div>
<main>
  <section class="py-4">
    <a href="/waretaskW/pages/secure/user/profile.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
  </section>
  <section>
    <!-- Formulário de criação ou visualização de tarefa -->
    <form action="/waretaskW/controllers/criar_tarefa.php" method="post" class="form-control py-3">
      <!-- Adicione os campos necessários para a tarefa -->
      <div class="input-group mb-3">
        <span class="input-group-text">Título</span>
        <input type="text" class="form-control" name="titulo" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $titulo; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Descrição</span>
        <textarea class="form-control" name="descricao" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> required><?php echo $descricao; ?></textarea>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Prioridade</span>
        <input type="text" class="form-control" name="prioridade" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $prioridade; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Data de Criação</span>
        <input type="text" class="form-control" name="dataCriacao" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $dataCriacao; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Prazo de Conclusão</span>
        <input type="text" class="form-control" name="prazoConclusao" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $prazoConclusao; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Estado</span>
        <input type="text" class="form-control" name="estado" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $estado; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Favorito</span>
        <input type="text" class="form-control" name="favorito" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $favorito; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Tarefa</span>
        <input type="text" class="form-control" name="tarefa" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $tarefa; ?>" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">ID do Usuário Criador</span>
        <input type="text" class="form-control" name="idUsuarioCreador" <?php echo $modoVisualizacao ? 'readonly' : ''; ?> value="<?php echo $idUsuarioCreador; ?>" required>
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