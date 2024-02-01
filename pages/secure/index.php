<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';
include_once __DIR__ . '../../../templates/header.php';

$user = usuario();
?>

<style>
    .welcome-section {
        background-color: #216869;
        color: #ffffff;
        padding: 20px;
    }

    .profile-card {
        position: absolute;
        bottom: 20px; /* Adjust the distance from the bottom */
        left: 20px; /* Adjust the distance from the left */
    }
</style>

<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <img src="/waretaskW/assets/images/logo-estg.svg" alt="ESTG" class="img-fluid mb-4">
            </div>
            <div class="col-md-12 text-center welcome-section">
                <?php if (isAuthenticated()): ?>
                    <h1 class="display-4 fw-bold">Welcome, <?= $user['name'] ?? 'Guest' ?>!</h1>
                <?php else: ?>
                    <h1 class="h3">Welcome, Guest!</h1>
                <?php endif; ?>
                <p class="lead">Ready for today?</p>
                <form action="/waretaskW/controllers/auth/login_auth.php" method="post" class="position-absolute top-0 end-0 mt-2 me-2">
                    <button class="btn btn-danger btn-lg" type="submit" name="usuario" value="logout">Logout</button>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <?php if (isAuthenticated()): ?>
                <div class="col-md-6 offset-md-3 mt-3 profile-card">
                    <div class="card h-100 bg-light">
                        <div class="card-body text-center">
                            <h2 class="card-title">Profile</h2>
                            <a href="/waretaskW/pages/secure/user/profile.php" class="btn btn-outline-primary">Change</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            if (isAuthenticated() && $user['administrator']) {
                echo '<div class="col-md-6 offset-md-3 mt-3">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <h2 class="card-title">Admin</h2>
                                <a href="/waretaskW/pages/secure/admin/" class="btn btn-outline-success">Admin</a>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>