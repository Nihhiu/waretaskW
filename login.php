<?php
session_start();

$servername = "localhost";
$usernameDB = "username";
$passwordDB = "password";
$dbname = "myDB";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernameDB, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn-> prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if($user){
        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['user'] = $user;
            header('Location: dashboard.php')
        } else{
            header('Location: login.php?error=wrongpassword');
        }
    } else{
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$_POST['username'], $hashedPassword]);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch();
        $_SESSION['user'] = $user;

        header('Location: dashboard.php');
    }
} catch(PDOException $e){
    echo "Error: " + $e->getMessage();
}

$conn = null;
?>