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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $name = $_POST['name']; 
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir .basename($image);
        $user_id = $_SESSION['user_id'];

        
        // Upload the image file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (name, price, category, image, user_id) VALUES ('$name', '$price', '$category', '$target_file', '$user_id')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the details page after successful insertion
                header("Location: product_details.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File upload error: " . $_FILES['image']['error'];
    }
}

$conn->close();

