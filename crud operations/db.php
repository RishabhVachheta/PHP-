<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// $sql  = "DELETE FROM MyGuests WHERE id=2";

//---------------------------------------------------------------------

$sql = "SELECT id, firstname, lastname FROM MyGuests ORDER BY lastname";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        echo "id:".$row["id"]."<br>"."Name:".$row["firstname"]."<br>".$row["lastname"]."<br>";
    }
} else {
    echo "0 results";
}

//-----------------------------------------------------------------------------

// $sql = "INSERT INTO MyGuests (id,firstname, lastname, email)
// VALUES (11,'John', 'Doe', 'john@example.com');";
// $sql .= "INSERT INTO MyGuests (id,firstname, lastname, email)
// VALUES (12,'Mary', 'Moe', 'mary@example.com');";
// $sql .= "INSERT INTO MyGuests (id,firstname, lastname, email)
// VALUES (13,'Julie', 'Dooley', 'julie@example.com')";

// if (mysqli_multi_query($conn, $sql)) {
//   echo "New records created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

mysqli_close($conn);
