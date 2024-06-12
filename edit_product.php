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
    $sql = "SELECT * FROM products WHERE id='$id' AND user_id='$user_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found or you do not have permission to edit this product.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE products SET name='$name', price='$price', category='$category' WHERE id='$id' AND user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: product_details.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="edit_product.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" value="<?php echo $row['category']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
$conn->close();
?>
