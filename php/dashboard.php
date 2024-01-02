<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: php/login.php");
    exit();
}
?>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>This is your dashboard.</p>