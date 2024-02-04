<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '/../../helpers/session.php';

// Check if the user is logged in
if (!isset($_SESSION['idTarefa'])) {
    // Redirect to login page or handle authentication as needed
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data (you should customize this according to your needs)
    $partilhaData = [
        'usuarioPartilhado' => htmlspecialchars($_POST['usuarioPartilhado']),
        'idTarefa' => intval($_POST['idTarefa']), // Assuming idTarefa is an integer
        // Add more fields as needed
    ];

    // Insert into the database
    $sql = "INSERT INTO partilha (usuarioPartilhado, idTarefa, created_at) 
            VALUES (:usuarioPartilhado, :idTarefa, NOW())";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':usuarioPartilhado', $partilhaData['usuarioPartilhado']);
    $stmt->bindParam(':idTarefa', $partilhaData['idTarefa']);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to a success page or do something else
        header("Location: success.php");
        exit();
    } else {
        // Handle errors, redirect to an error page, or show an error message
        echo "Error creating Partilha. Please try again.";
    }
}

function getPartilhaByIdUsuario($idTarefa)
{
    global $pdo;

    // Fetch Partilhas based on idTarefa
    $sql = "SELECT * FROM partilha WHERE idTarefa = :idTarefa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idTarefa', $idTarefa);
    $stmt->execute();

    // Fetch the results as an associative array
    $partilhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $partilhas;
}

// Example usage
$idTarefa = $_SESSION['idTarefa']; // Use the actual user ID from the session
$partilhas = getPartilhaByIdUsuario($idTarefa);

// Display or process the $partilhas array as needed
foreach ($partilhas as $partilha) {
    echo "Title: " . $partilha['title'] . "<br>";
    echo "Description: " . $partilha['description'] . "<br>";
    // Add more fields as needed
    echo "<hr>";
}

function getPartilhaByidTarefa($idTarefa)
{
    global $pdo;

    // Fetch Partilhas based on idTarefa
    $sql = "SELECT * FROM partilha WHERE idTarefa = :idTarefa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idTarefa', $idTarefa);
    $stmt->execute();

    // Fetch the results as an associative array
    $partilhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $partilhas;
}

// Example usage
$idTarefa = 123; // Replace with the actual task ID
$partilhas = getPartilhaByidTarefa($idTarefa);

// Display or process the $partilhas array as needed
foreach ($partilhas as $partilha) {
    echo "Title: " . $partilha['title'] . "<br>";
    echo "Description: " . $partilha['description'] . "<br>";
    // Add more fields as needed
    echo "<hr>";
}

function deletePartilhaByIdUsuario($idTarefa)
{
    global $pdo;

    // Delete Partilhas based on idTarefa
    $sql = "DELETE FROM partilha WHERE idTarefa = :idTarefa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idTarefa', $idTarefa);

    // Execute the query
    if ($stmt->execute()) {
        // Return true if deletion is successful
        return true;
    } else {
        // Return false if deletion fails
        return false;
    }
}

// Example usage
$idTarefa = $_SESSION['idTarefa']; // Use the actual user ID from the session
if (deletePartilhaByIdUsuario($idTarefa)) {
    echo "Partilhas deleted successfully.";
} else {
    echo "Error deleting Partilhas.";
}

function deletePartilhaByIdTarefa($idTarefa)
{
    global $pdo;

    // Delete Partilhas based on idTarefa
    $sql = "DELETE FROM partilha WHERE idTarefa = :idTarefa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idTarefa', $idTarefa);

    // Execute the query
    if ($stmt->execute()) {
        // Return true if deletion is successful
        return true;
    } else {
        // Return false if deletion fails
        return false;
    }
}

// Example usage
$idTarefa = 123; // Replace with the actual task ID
if (deletePartilhaByIdTarefa($idTarefa)) {
    echo "Partilhas deleted successfully.";
} else {
    echo "Error deleting Partilhas.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Partilha</title>
</head>
<body>
    <h1>Create Partilha</h1>
    
    <!-- Your HTML form for creating Partilha -->
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="usuarioPartilhado">Shared User:</label>
        <input type="text" id="usuarioPartilhado" name="usuarioPartilhado" required>

        <label for="idTarefa">Task ID:</label>
        <input type="number" id="idTarefa" name="idTarefa" required>

        <button type="submit">Create Partilha</button>
    </form>
</body>
</html>



