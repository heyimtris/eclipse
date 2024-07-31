<?php 

// open connection 
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection


// get id of message from params
$id = $_GET['id'];
$sender = $_GET['sender'];
$receiver = $_GET['receiver'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get an array of all the messages from the sender and receiver and vice versa

$sql = "SELECT * FROM messages WHERE (sender = '$sender' AND recipient = '$receiver') OR (sender = '$receiver' AND recipient = '$sender')";
$result = $conn->query($sql);

// go through each row, make the index var up by one, and check if the id is equal to the current index

$index = 0;
while ($row = $result->fetch_assoc()) {
    if ($index == ($id - 1)) {
        // get the message content
        $messageContent = $row['content'];
        $messageSender = $row['sender'];
        // return the message content and sender in JSON format
        echo json_encode(array('content' => $messageContent,'sender' => $messageSender, 'timestamp' => $row['timestamp'], 'attachments' => $row['attachments']));
        break;
    }
    $index++;
}

// if the id is not found, return an error message

if ($index == $id) {
    echo "Error: Message not found";
}

// close connection

$conn->close();

?>