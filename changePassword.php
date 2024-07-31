<?php

// connect to database
$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// get email and new password from post request
$email = $_POST['email'];
$newPassword = $_POST['password'];

// hash the new password

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// update the password in the database

$sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";

if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully. You can now log in with your new password.  <a href='login/'>Login</a>";
} else {
    echo "Error updating password: ". $conn->error;
}

// close the database connection

$conn->close();

?>