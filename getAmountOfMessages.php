<?php

// connect to database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get sender and receiver from the GET request

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];

// check if sender and receiver are valid

if (empty($sender) || empty($receiver)) {
    die("Sender and receiver are required");
}

// check if sender and receiver are not the same user

if ($sender === $receiver) {
    die("Sender and receiver cannot be the same user");
}

// check if sender and receiver exist as users in the database

$userQuery = $conn->query("SELECT * FROM users WHERE id IN ('$sender', '$receiver')");

if ($userQuery->num_rows < 2) {
    die("Sender and receiver must be valid users");
}

// get amount of messages between sender and receiver

$sql = "SELECT COUNT(*) AS total_messages FROM messages WHERE (sender = '$sender' AND recipient = '$receiver') OR (sender = '$receiver' AND recipient = '$sender')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo $row['total_messages'];

// close the database connection

$conn->close();

?>