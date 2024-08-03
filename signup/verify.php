<?php

session_start();
// connect to database

$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// get verification code from get parameter

$verificationCode = $_GET['code'];

// get user username from session

$user = $_SESSION['username'];

// check if verification code is active

$sql = "SELECT * FROM verification_codes WHERE code = '$verificationCode' AND active = 1";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Invalid/Expired verification code.");
}
// mark verification code as inactive

$sql = "DELETE FROM verification_codes WHERE code = '$verificationCode' LIMIT 1";
$conn->query($sql);

// update user's status to active

$sql = "UPDATE users SET verified = 1 WHERE username = '$user'";

$conn->query($sql);

echo "Your account has been verified. You can now log in.";

// close connection

$conn->close();

?>

<a href="../login/">Login</a>