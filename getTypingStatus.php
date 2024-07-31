<?php

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get user from get request

$user = $_GET['user'];

// get user's typing status from database

$sql = "SELECT typing FROM users WHERE id = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['typing'];
} else {
    echo "User not found";
}

// close connection

$conn->close();

?>