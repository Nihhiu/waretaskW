<?php
// Storing session data
session_start();

// Defining register button variable
if(isset($_POST['register']))
{
    // Assigning post values to variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Checking if the password matches
    if($password == $confirm_password)
    {
        // Importing the database connection
        require_once 'db_connect.php';

        // Checking if the user exists in the database
        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

        // If the user exists
        if($count == 1)
        {
            // Printing error message
            echo "The username or email is already in use!";
        }
        else
        {
            // Inserting new user to the database
            $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
            if(mysqli_query($conn, $query))
            {
                // Printing success message
                echo "New user has been registered successfully!";
            }
            else
            {
                // Printing error message
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }
    else
    {
        // Printing error message
        echo "Passwords do not match!";
    }
}
?>

