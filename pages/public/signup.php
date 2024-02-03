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
      <link rel="stylesheet" href="base.css">
  </head>

  <body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg">
      <div class="container container-color">
        <a class="navbar-brand" href="/waretaskW/index.php">
          <p class="fw-bold fs-4"><img src="../../assets/images/Logo.png" alt="logo" width="100" height="100"> WareTask</p>
        </a>
      </div>
    </nav>

    <!-- CONTENT -->
    <!-- Refere tudo o que o utilizador tem de disponibilizar antes de rposseguir -->
    <main class="container mt-4">

      <!-- Feedback sobre Sign up -->
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
      <!-- Sign Up Form -->
      <form action="../../controllers/auth/signup_auth.php" method="post" class="needs-validation" novalidate>
        <h1 class="h3 mb-3 fw-normal">Sign Up</h1>
        <div class="row g-2 mb-2">
          <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="100"
                  value="<?= isset($_REQUEST['nome']) ? $_REQUEST['nome'] : '' ?>" required>
                <label for="nome">Nome</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="username" placeholder="Username" maxlength="50"
                      value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : '' ?>" required>
                <label for="username">Username</label>
            </div>
          </div>
        </div>

        <div class="row g-1 mb-2">
          <div class="col-md-12">
            <div class="form-floating">
                <input type="text" class="form-control" name="email" placeholder="name@example.com"
                  value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : '' ?>" required>
                <label for="email">Email</label>
            </div>
          </div>
        </div>

        <div class="row g-2 mb-2">
          <div class="col-md-6">
            <div class="form-floating">
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                <label for="senha">Senha</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
                <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar senha" required>
                <label for="confirmar_senha">Confirmar Senha</label>
            </div>
          </div>
        </div>
        <!-- Botão Sign Up -->
        <a class="d-block text-center mt-1"><button class="btn btn-lg btn-success mt-3" type="submit" name="usuario" value="signup">Sign Up</button></a>
      </form> 

      <!-- Voltar Button -->
      <div class="d-block text-center mt-1"><a href="/waretaskW/index.php"><button class="btn btn-lg btn-danger mt-3">Voltar ao Menu</button></a></div>
    </main>

    <!-- FOOTER -->
    <?php
    include_once __DIR__ . '../../../templates/footer.php';
    ?>
  </body>
</html>