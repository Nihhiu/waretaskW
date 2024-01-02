<?php
session_start();

// Include database connection code
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the entered credentials are valid
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: ../dashboard.php"); // Redirect to the dashboard or home page
        exit();
    } else {
        // Login failed
        echo "Invalid username or password";
    }
}
?>