<?php

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn -> connect_error) {
    die("Connection failed: ". $conn -> connect_error);
}

// get user from get request
$user = $_GET["user"];

// get user's avatar 

    $query = "SELECT avatar FROM users WHERE username = '$user'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();
    if ($result -> num_rows > 0) {
    $avatar = $row["avatar"];
    echo $avatar;
    } else {
    $avatar = "images/default.png";
    }


// close database connection

$conn -> close();

?>