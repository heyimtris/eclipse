<?php
$email = $_POST['email'];
$username = $_POST['username'];

// Database connection

$conn = new mysqli('localhost', 'root', '', 'eclipse');

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}   

$timestamp = time();

$existingUser = $conn->query("SELECT * FROM users WHERE email='$email' OR username='$username'");

if ($existingUser->num_rows > 0) {
    echo "Email or username already exists";
    exit();
}

// check if username matches regex pattern

if (!preg_match('/^[a-zA-Z0-9_]{3,16}$/', $username)) {
    echo "Username must be between 3 and 16 characters long and contain only letters, numbers, and underscores";
    exit();
}

$encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO `users`(`id`, `avatar`, `email`, `username`, `nickname`, `password`, `status`, `custom_status`, `bio`, `friends`) VALUES ('$timestamp',default,'$email','$username',null,'$encryptedPassword','online',null,null,'[]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

session_start();
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;

$conn->close();

header("Location: confirmEmail.php");  // Redirect to email confirmation page after registration successful.
?>