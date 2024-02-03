<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Change password';
$user = usuario();
?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1>Change Password</h1>
</div>
<main>
  <section class="py-4">
    <a href="/waretaskW/pages/secure/user/profile.php"><button type="button" class="btn btn-secondary px-5">Back</button></a>
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
  <section>
    <form action="/waretaskW/controllers/admin/user.php" method="post" class="form-control py-3">
      <!-- Verificar Senha Section -->
      <div class="row g-1 mb-2">
        <div class="col-md-12">
          <div class="input-group mb-3">
            <span class="input-group-text">Senha Atual</span>
            <input type="password" class="form-control" name="senha_atual" placeholder="Senha Atual" maxlength="100" size="100"
                value="<?= isset($_REQUEST['senha_atual']) ? $_REQUEST['senha_atual'] : '' ?>" required>
          </div>
        </div>
      </div>
      <!-- Nova Senha Section -->
      <div class="row g-2 mb-2">
        <div class="col-md-6">
          <div class="input-group mb-3">
            <span class="input-group-text">Nova Senha</span>
            <input type="password" class="form-control" name="nova_senha" placeholder="Nova Senha" maxlength="100" size="100"
                value="<?= isset($_REQUEST['nova_senha']) ? $_REQUEST['nova_senha'] : '' ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3">
            <span class="input-group-text">Confirmar Senha</span>
            <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar Senha" maxlength="100" size="100"
                value="<?= isset($_REQUEST['confirmar_senha']) ? $_REQUEST['confirmar_senha'] : '' ?>" required>
          </div>
        </div>
      </div>
      <div class="d-grid col-4 mx-auto">
        <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="usuario" value="senha">Change</button>
      </div>
    </form>
  </section>
</main>
<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>