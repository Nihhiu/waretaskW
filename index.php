<?php
require_once __DIR__ . '/infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/setupdatabase.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WareTask</title>
    <!-- Tab Icon -->
    <link rel="shortcut icon" href="assets/images/Logo.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid container-color">
            <a class="navbar-brand" href="/waretaskW/pages/secure/">
            <p style="font-weight: 700; font-size: 24px;"><img src="/waretaskW/assets/images/Logo.png" alt="logo" width="100"
                height="100" style="margin-left: 10vh;"> WareTask</p>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="margin-right: 10vh;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary shadow-sm d-sm d-block nav-link" href="pages/public/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary shadow-sm d-sm d-block nav-link" href="pages/public/signup.php">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Apresenta a página inicial -->
    <!-- CONTENT -->

    <div class="caribbean-current-container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="text-center">
                    <h1 class="text-primary white-text">Conecta o teu trabalho em um só lugar</h1>
                    <p class="lead platinum-text">Com o WareTask, pode integrar todas as suas ferramentas, tarefas e
                        fluxos de trabalho. 
                        <br>
                        Simplifique a sua vida e aumente a produtividade.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="assets/images/gestao.png" alt="office" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container mt-5 space">
        <h2 class="text-center text-primary caribbean-current-text">Funcionalidades</h2>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-up-right-square fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Automação</h5>
                        <p class="card-text">Automatize as suas tarefas repetitivas, tenha mais tempo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-up-right-square fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Organização</h5>
                        <p class="card-text">Organiza as tuas tarefas, projetos, e equipas mais eficiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-up-right-square fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Eficiência</h5>
                        <p class="card-text">Não perca tempo, Trabalhe no que realmente importa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container align-content-start">
        <div class="row">
            <div class="container col-lg-6 align-content-start space">
                <h2 class="text-primary caribbean-current-text">Sobre Nós</h2>
                <p class="card-text eerie-black-text">Na WareTask, dedicamo-nos a fornecer soluções de gestão de tarefas
                    inovadoras e eficientes. O nosso foco principal é o desenvolvimento de sistemas informáticos
                    avançados que simplificam os processos de gestão de tarefas, permitindo que as empresas atinjam os
                    seus objectivos de forma mais eficaz.</p>
            </div>
            <div class="col-lg-6">
                <img src="assets/images/gestao2.png" alt="office" class="img-fluid">
            </div>
        </div>
    </div>
    </div>


    <div class="container mt-5 space">
        <h2 class="text-center text-primary caribbean-current-text">Equipa</h2>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-up-right-square fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Sérgio Gabriel</h5>
                        <img src="assets/images/Gabriel.png" alt="office" class="img-fluid team-member-image">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-up-right-square fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Carlos Veloso</h5>
                        <img src="assets/images/carlos.jpg" alt="office" class="img-fluid team-member-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->

<?php
include_once __DIR__ . '/templates/footer.php';
?>