<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../../infra/repositories/tarefaRepository.php';
require_once __DIR__ . '../../../../infra/repositories/partilhaRepository.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Visualizar Tarefa';
$user = usuario();
$tarefa = getTarefaById($_GET['idTarefa']);
$partilha = getPartilhaByIdTarefa($_GET['idTarefa']);
?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1 class="container"><?= $tarefa['titulo'] ?? null ?></h1>
</div>
<main>
  <div class="container">

    <section class="py-4">
      <a href="/waretaskW/pages/secure/tarefa/visualizar_lista_tarefa.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
      <a href='editar_tarefa.php?idTarefa=<?= $tarefa['idTarefa'] ?>' class='btn btn-warning  px-5'>Editar Tarefa</a>
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

  </div>
  <div class="container">
    <div class="row g-2">

      <!-- Campos da Tarefa -->  
      <div class="col-md-6">  
        <p class="lead mt-4">Descrição: <?= $tarefa['descricao'] ?? null ?></p>
        <p class="lead mt-2">Prioridade: <?= $tarefa['prioridade'] ?? null ?></p>
        <p class="lead mt-2">Data de Criação: <?= $tarefa['dataCriacao'] ?? null ?></p>
        <p class="lead mt-2">Prazo: <?= $tarefa['prazoConclusao'] ?? null ?></p>
        <p class="lead mt-2">Estado: <?= $tarefa['estado'] ?? null ?></p>
        <span class="input-group lead mt-2">Favorito 
          <input type="checkbox" class="form-check-input lead" name="favorito" value="1" <?= isset($tarefa['favorito']) && $tarefa['favorito'] == 1 ? 'checked' : '' ?> disabled>
        </span>

        <!-- Anexos -->  
        <?php if (isset($tarefa['anexo'])){ ?>
          <p class="lead mt-5">Anexos: </p>
          <div class="form-floating mb-3">               
            <i><?= $tarefa['anexo']['nomeAnexo'] ?></i>
            <a href="<?= $tarefa['anexo']['caminhoAnexo'] ?>" class="btn btn-primary" download>Descarregar Anexo</a>
            <input type="hidden" name="idAnexos" value="<?= $tarefa['anexo']['idAnexos'] ?>">
            <input type="hidden" name="caminhoAnexo" value="<?= $tarefa['anexo']['caminhoAnexo'] ?>">
          </div>
        <?php } ?>
      </div>

      <!-- Campo das Partilhas -->  
      <div class="col-md-6">

        <!-- Adicionar Partilha -->  
        <p class="lead mt-2">Partilhar Tarefa</p>
        <?php
          if ($tarefa['idUsuarioCreador'] == usuarioID()){
        ?>
        <form action="/waretaskW/controllers/tarefa/partilha_controller.php" method="post">
          <div class="row g-2">
            <div class="form-floating col-md-8 mb-2">
              <input type="hidden" name="idTarefa" value="<?= $tarefa['idTarefa'] ?>">
              <input type="text" class="form-control" id="email_or_username" placeholder="Email or Username" name="email_or_username" maxlength="255"
                value="<?= isset($_REQUEST['email_or_username']) ? $_REQUEST['email_or_username'] : null ?>">
              <label for="email_or_username">Email ou Username</label>
            </div>
            <div class="col-md-4">
              <a><button class="btn btn-lg btn-success" type="submit" name="partilha" value="create">Partilhar</button></a>
            </div>
          </div>
        </form>
        <?php
          }
        ?>
        <!-- Listar e Remover Partilha -->  
        
        <?php
        if (!empty($partilha)) {
          foreach ($partilha as $unicaPartilha) {
        ?>  
              <div class="card shadow mb-5 rounded">
                <div class="row g-2 d-flex align-items-center">
                  <div class="col-md-6">
                    <p class="px-2"><?= $unicaPartilha['email'] ?? null ?></p>
                  </div>
                  <div class="col-md-6">
                    <form action="/waretaskW/controllers/tarefa/partilha_controller.php" method="post">
                      <input type="hidden" name="idTarefa" value="<?= $unicaPartilha['idTarefa'] ?>">
                      <input type="hidden" name="usuarioPartilhado" value="<?= $unicaPartilha['usuarioPartilhado'] ?>">
                      <?php
                          if ($tarefa['idUsuarioCreador'] == usuarioID()){
                      ?>
                        <button class="btn btn-danger mt-2 w-100" type="submit" name="partilha" value="delete">Eliminar Partilha</button>
                      <?php
                        }
                      ?>
                    </form>
                  </div>
                </div>
              </div>
        <?php
          }
        }
        ?>

      </div>
    </div>
  </div>
    
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>