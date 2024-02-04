<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>WareTask</title>
      <!-- Tab Icon -->
      <link rel="shortcut icon" href="../../assets/images/Logo.png" type="image/x-icon">
      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <!-- CSS -->
      <link rel="stylesheet" href="../../base.css">
  </head>

  <body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid container-color">
        <a class="navbar-brand" href="/waretaskW/pages/secure/">
          <p style="font-weight: 700; font-size: 24px;"><img src="/waretaskW/assets/images/Logo.png" alt="logo" width="100"
              height="100" style="margin-left: 10vh;"> WareTask</p>
        </a>
      </div>
    </nav>

    <!-- CONTENT -->
    <!-- Diz o que o utilizador precisa para proceder -->
    <main>
      <div class="container">
        
        <!-- Feedback sobre Sign up -->
        <section>
          <?php
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
        <!-- Sign Up Form -->
        <form action="../../controllers/auth/login_auth.php" method="post">
          <h1 class="h3 mb-3 fw-normal">Login</h1>
          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="EmailOrUsername" placeholder="Email or Username" name="email_or_username" maxlength="255"
              value="<?= isset($_REQUEST['email_or_username']) ? $_REQUEST['email_or_username'] : null ?>">
            <label for="EmailOrUsername">Email ou Username</label>
          </div>
          <div class="form-floating mb-2">
            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" maxlength="255"
              value="<?= isset($_REQUEST['senha']) ? $_REQUEST['senha'] : null ?>">
            <label for="password">Password</label>
          </div>
          <!-- Botão login -->
          <a class="d-block text-center mt-1"><button class="btn btn-lg btn-success mt-3" type="submit" name="usuario" value="login">Login</button></a>
        </form>

        <!-- Voltar Button -->
        <div class="d-block text-center mt-1"><a href="/waretaskW/index.php"><button class="btn btn-lg btn-danger mt-3">Voltar ao Menu</button></a></div>
      </div>
    </main>

  <!-- FOOTER -->
  <?php
  include_once __DIR__ . '../../../templates/footer.php';
  ?>
</html>