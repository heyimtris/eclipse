<?php

// connect to da database
$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// get url params

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];
$attachments = $_POST['attachments'];
$attachments = json_encode($attachments);

// post the message to the database

// get unix timestamp
$timestamp = time();

// get amount of messages in database
$sql = "SELECT COUNT(*) AS total_messages FROM messages";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_messages = $row['total_messages'];

$id = $total_messages + 1;

$sql = "INSERT INTO messages (id, sender, recipient, content, timestamp, attachments) VALUES ($id, '$sender', '$receiver', '$message', '$timestamp', '$attachments')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// close the database connection

$conn->close();

?>