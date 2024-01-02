<!-- signup_process.php -->
<?php
// Include database connection code
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username is already taken
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        echo "Username already taken. Please choose another.";
    } else {
        // Insert the new user into the database
        $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $insert_user_result = mysqli_query($conn, $insert_user_query);

        if ($insert_user_result) {
            echo "Registration successful! You can now login.";
        } else {
            echo "Error during registration. Please try again.";
        }
    }
}
?>