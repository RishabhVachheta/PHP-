<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "new database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete the product
    $sql = "DELETE FROM products WHERE id='$id' AND user_id='$user_id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: product_details.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();

