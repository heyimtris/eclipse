<?php

session_start();

if (!$_SESSION['id']) {
    echo "You were logged out. Refresh the page to log back in.";
}

// connect to Eclipse database
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$loggedInUser = $_SESSION['id'];
$requestedUser = $_POST["requestedUser"];

// check if the requested user exists in the database

$query = "SELECT username FROM users WHERE username = '$requestedUser'";
$result = $conn->query($query);

if (!$result->num_rows > 0) {
    echo "User does not exist";
    return;
}

// check if the user is already in the friend list of the logged in user

$query = "SELECT * FROM users WHERE username = '$requestedUser'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$reqId = $row['id'];

$query = "SELECT friends FROM users WHERE id = '".$reqId."'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$friends = json_decode($row['friends']);

if (in_array($reqId, $friends)) {
    echo "You are already friends with this user";
    // stop the script
    return;
}

// get all friend requests sent by the logged in user
$query = "SELECT * FROM friend_requests WHERE sender = '$reqId'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
  foreach ($result as $row) {
    if ($row['sender'] == $loggedInUser) {
        if ($row['recipient'] == $reqId) {
            echo "Friend request already sent!";
            return;
        }
    }
  }
}

// add the friend request to the database
$sql = "INSERT INTO friend_requests (sender, recipient) VALUES ('$loggedInUser', '$reqId')";

if ($conn->query($sql) === TRUE) {
    echo "Friend request sent successfully";
} else {
    // echo "Error: ". $sql. "<br>". $conn->error;
}

// close the database connection

$conn->close();

?>