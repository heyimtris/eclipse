<?php

// connect to server
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get post info
$username = $_POST['id'];
$typing = $_POST['typing'];

// find user by username

$sql = "SELECT * FROM users WHERE id= '$username'";
$result = $conn->query($sql);

// if user exists

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // check if user is typing

    if ($typing !== null) {
        $sql = "UPDATE users SET typing = '$typing' WHERE id = '$username'";
        $conn->query($sql);
    } else {
        $sql = "UPDATE users SET typing = NULL WHERE id = '$username'";
        $conn->query($sql);
    }
}

// close connection

$conn->close();

?>