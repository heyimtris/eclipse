<?php 

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn -> connect_error) {
    die("Connection failed: ". $conn -> connect_error);
}

// get user from request
$user = $_GET["user"];

// get user's status from database

$query = "SELECT status FROM users WHERE id = '$user'";

$result = $conn -> query($query);

if ($result -> num_rows > 0) {
    $row = $result -> fetch_assoc();
    echo $row["status"];
} else {
    echo "User not found";
}

// close connection

$conn -> close();

?>