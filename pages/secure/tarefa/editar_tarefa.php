<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../../infra/repositories/tarefaRepository.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Editar Tarefa';
$user = usuario();
$_REQUEST = getTarefaById($_GET['idTarefa']);

?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1 class="container">Editar Tarefa</h1>
</div>

<main>
  <div class="container">
    <section class="py-4">
      <a href='visualizar_tarefa.php?idTarefa=<?= $_REQUEST['idTarefa'] ?>'><button type="button" class="btn btn-secondary px-5">Back</button></a>
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
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['errors']);
      }
      ?>
    </section>
    <section>
      <!-- Formulário de criação de tarefa -->
      <form action="/waretaskW/controllers/tarefa/tarefa_controller.php" method="post" enctype="multipart/form-data" class="form-control py-3">
        <!-- Adicione os campos necessários para a tarefa -->
        <div class="align-items-center">
          <!-- Titulo -->
          <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input type="hidden" name="idTarefa" value="<?= $_REQUEST['idTarefa']?>">
                <input type="text" class="form-control" name="titulo" placeholder="Título" maxlength="50" style="border-radius: 20px;" value="<?= isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '' ?>" required>
                <label for="titulo">Título*</label>
              </div>
            </div>
          </div>
          <!-- Descrição -->
          <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <textarea class="form-control" name="descricao" placeholder="Descrição" rows="4" style="border-radius: 20px;" ><?= isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : '' ?></textarea>
                <label for="descricao">Descrição</label>
              </div>
            </div>
          </div>
          <!-- Prioridade -->
          <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <select class="form-control" name="prioridade" style="border-radius: 20px;" required>
                    <option value="Baixa" <?= isset($_REQUEST['prioridade']) && $_REQUEST['prioridade'] == 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                    <option value="Média" <?= isset($_REQUEST['prioridade']) && $_REQUEST['prioridade'] == 'Média' ? 'selected' : '' ?>>Média</option>
                    <option value="Alta" <?= isset($_REQUEST['prioridade']) && $_REQUEST['prioridade'] == 'Alta' ? 'selected' : '' ?>>Alta</option>
                </select>
                <label for="prioridade">Prioridade*</label>
              </div>
            </div>
          </div>
          <!-- Datas -->
          <div class="row g-2 mb-2 justify-content-center">
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="dataCriacao" style="border-radius: 20px;" value="<?= date('Y-m-d') ?>" required>
                    <label for="dataCriacao">Data de Criação*</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="prazoConclusao" style="border-radius: 20px;" value="<?= $_REQUEST['prazoConclusao'] ?>" required>
                    <label for="prazoConclusao">Data de Finalização*</label>
                </div>
            </div>
          </div>
          <!-- Estado -->
          <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <select class="form-control" name="estado" style="border-radius: 20px;" required>
                    <option value="Para Fazer" <?= isset($_REQUEST['estado']) && $_REQUEST['estado'] == 'Para Fazer' ? 'selected' : '' ?>>Para Fazer</option>
                    <option value="A Fazer" <?= isset($_REQUEST['estado']) && $_REQUEST['estado'] == 'A Fazer' ? 'selected' : '' ?>>A Fazer</option>
                    <option value="Feito" <?= isset($_REQUEST['estado']) && $_REQUEST['estado'] == 'Feito' ? 'selected' : '' ?>>Feito</option>
                    <option value="Vencido" <?= isset($_REQUEST['estado']) && $_REQUEST['estado'] == 'Vencido' ? 'selected' : '' ?>>Vencido</option>
                </select>
                <label for="estado">Estado*</label>
              </div>
            </div>
          </div>
          <!-- Favorito -->
        <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <span class="input-group">Favorito 
                  <input type="checkbox" class="form-check-input" name="favorito" value="1" <?= isset($_REQUEST['favorito']) && $_REQUEST['favorito'] == 1 ? 'checked' : '' ?>>
                </span>
              </div>
            </div>
        </div>
          <!-- Tipo de Tarefa -->
        <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input type="hidden" name="idUsuarioCreador" value="<?= isset($_REQUEST['idUsuarioCreador']) ? $_REQUEST['idUsuarioCreador'] : null ?>">
                <input type="text" class="form-control" name="tarefa" placeholder="Tipo de Tarefa" style="border-radius: 20px;"
                  value="<?= isset($_REQUEST['tarefa']) ? $_REQUEST['tarefa'] : '' ?>">
                <label for="tarefa">Tipo de Tarefa</label>
              </div>
            </div>
        </div>

          <!-- Anexos -->
        <div class="row g-1 mb-2 justify-content-center">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <?php if (isset($_REQUEST['anexo'])): ?>
                        <!-- Se um anexo existir, mostrar um link para baixar o anexo e um botão para deletar o anexo -->                        
                        <a><?= $_REQUEST['anexo']['nomeAnexo'] ?></a>
                        <a href="<?= $_REQUEST['anexo']['caminhoAnexo'] ?>" class="btn btn-primary" download>Descarregar Anexo</a>
                        <input type="hidden" name="idAnexos" value="<?= $_REQUEST['anexo']['idAnexos'] ?>">
                        <input type="hidden" name="caminhoAnexo" value="<?= $_REQUEST['anexo']['caminhoAnexo'] ?>">
                        <button name="tarefa_cont" value="deleteAnexo" type="submit" class="btn btn-danger">Deletar Anexo</button>
                    <?php else: ?>
                        <!-- Se nenhum anexo existir, mostrar um campo para carregar um anexo -->
                        <div class="row g-1 mb-2 justify-content-center">
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="file" name="anexo"
                                value="<?= isset($_FILES['anexo']) ? $_FILES['anexo'] : '' ?>">
                            </div>
                          </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Botão de envio -->
        <div class="d-grid col-4 mx-auto">
          <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="tarefa_cont" value="update">Submeter Alterações</button>
        </div>
      </form>
    </section>  
  </div>
  
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>