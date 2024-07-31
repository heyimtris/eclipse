<?php 

// connect to database
$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// get username from post request

if (!$_POST['username']) {
    $id = $_POST['id'];
    $req = "id = '$id'";
} else {
    $username = $_POST['username'];
    $req = "username = '$username'";
}

// get status from post request

$status = $_POST['customStatus'];

$query = "SELECT * FROM users WHERE $req";

$result = $conn->query($query);

$row = $result->fetch_assoc();

$query = "UPDATE users SET custom_status = '$status' WHERE $req";


if ($conn->query($query) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: ". $conn->error;
}

// close the database connection

$conn->close();

?>