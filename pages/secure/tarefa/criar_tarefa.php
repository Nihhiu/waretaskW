<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Criar Tarefa';
$user = usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o formulário foi submetido
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
  <h1>Criar Tarefa</h1>
</div>
<main>
  <section class="py-4">
    <a href="/waretaskW/pages/secure/user/profile.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
  </section>
  <section>
    <!-- Formulário de criação de tarefa -->
    <form action="/waretaskW/controllers/criar_tarefa.php" method="post" class="form-control py-3">
      <!-- Adicione os campos necessários para a tarefa -->
      <div class="input-group mb-3">
        <span class="input-group-text">Título</span>
        <input type="text" class="form-control" name="titulo" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Descrição</span>
        <textarea class="form-control" name="descricao" required></textarea>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Prioridade</span>
        <input type="text" class="form-control" name="prioridade" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Data de Criação</span>
        <input type="text" class="form-control" name="dataCriacao" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Prazo de Conclusão</span>
        <input type="text" class="form-control" name="prazoConclusao" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Estado</span>
        <input type="text" class="form-control" name="estado" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Favorito</span>
        <input type="text" class="form-control" name="favorito" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Tarefa</span>
        <input type="text" class="form-control" name="tarefa" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">ID do Usuário Criador</span>
        <input type="text" class="form-control" name="idUsuarioCreador" required>
      </div>

      <!-- Botão de envio -->
      <div class="d-grid col-4 mx-auto">
        <button class="w-100 btn btn-lg btn-success mb-2" type="submit">Criar Tarefa</button>
      </div>
    </form>
  </section>
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>