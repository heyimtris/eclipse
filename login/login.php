<?php

session_start();
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection

$conn = new mysqli('localhost', 'root', '', 'eclipse');

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}   

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['avatar'] = $row['avatar'];
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['custom_status'] = $row['custom_status'];
            $_SESSION['friends'] = json_decode($row['friends']);
            $_SESSION['id'] = $row['id'];
            echo "<script>localStorage.setItem('email', '$email');</script>";
            echo "<script>localStorage.setItem('password', '$password');</script>";

            header("Location: ../app/index.php");
        } else {
            echo "Invalid password";
        }
    }
} else {
    echo "Username does not exist";
}

$conn->close();

?>