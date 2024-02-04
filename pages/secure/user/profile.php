<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Profile';
$user = usuario();
?>

<div class="p-5 mb-2 bg-dark text-white">
  <h1 class="container">Perfil</h1>
</div>

<main>
  <div class="container">
    <section class="py-4">
      <div class="d-flex justify-content">
        <a href="/waretaskW/"><button type="button" class="btn btn-secondary px-5 me-2">Back</button></a>
        <a href="./password.php"><button class="btn btn-warning px-2 me-2">Change Password</button></a>
        <form action="/waretaskW/controllers/auth/login_auth.php" method="post" class="position-absolute top-0 end-0 mt-2 me-2">
          <button class="btn btn-danger btn-lg" type="submit" name="usuario" value="logout">Logout</button>
        </form>
      </div>
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
      <form enctype="multipart/form-data" action="/waretaskW/controllers/admin/user.php" method="post"
        class="form-control py-3">
        <div class="input-group mb-3">
          <span class="input-group-text">Nome</span>
            <input type="text" class="form-control" name="nome" placeholder="nome" maxlength="100" size="100"
              value="<?= isset($_REQUEST['nome']) ? $_REQUEST['nome'] : (isset($user['nome']) ? $user['nome'] : '') ?>" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Username</span>
            <input type="text" class="form-control" name="username" placeholder="username" maxlength="100" size="100"
              value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : (isset($user['username']) ? $user['username'] : '') ?>" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Senha</span>
            <input type="password" class="form-control" name="senha" maxlength="9"
              value="<?= isset($_REQUEST['senha']) ? $_REQUEST['senha'] : (isset($user['senha']) ? $user['senha'] : '') ?>" required readonly>  
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Email</span>
            <input type="email" class="form-control" name="email" maxlength="255"
              value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : (isset($user['email']) ? $user['email'] : '') ?>" required>
        </div>
        <div class="d-grid col-4 mx-auto">
          <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="usuario" value="profile">Change</button>
        </div>
      </form>
    </section> 
  </div>
  
</main>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>