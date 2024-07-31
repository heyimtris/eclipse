<?php

session_start();

// connect to THE DATABASE !
$conn = new mysqli("localhost", "root", "", "eclipse");

// check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get username from the POST request

$username = $_POST['username'];

// get this users data from the database

$sql = "SELECT * FROM users WHERE id = '$username'";

$result = $conn->query($sql);

// check if the user exists

if (!$result->num_rows > 0) {
  die("User does not exist.");
}
  $row = $result->fetch_assoc();


// get friend requests from the database

$sql = "SELECT * FROM friend_requests WHERE recipient = '".$_SESSION['id']."' AND sender = '".$row['id']."'";

$result = $conn->query($sql);

echo $_SESSION['id'] . " -> ". $row['id'];

// check if there are any friend requests

if (!$result->num_rows > 0) {
 echo "Friend request not found (or already accepted).";
} else {
 $sql = "DELETE FROM friend_requests WHERE recipient = '".$_SESSION['id']."' AND sender = '".$row['id']."'";
 $conn->query($sql);

 // update friend lists in both users' tables
 $sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
 $result = $conn->query($sql);
 $userData = $result->fetch_assoc();
 $userData['friends'] = json_decode($userData['friends']);
 // add the requested user to the user's friends list
 array_push($userData['friends'], $row['id']);
 $userData['friends'] = json_encode($userData['friends']);
 $sql = "UPDATE users SET friends = '$userData[friends]' WHERE id = '".$_SESSION['id']."'";
if ($conn->query($sql) !== TRUE) {
 echo "Error updating friend list: ". $conn->error;
}


 $sql = "SELECT * FROM users WHERE id = '".$row['id']."'";
 $result = $conn->query($sql);
 $userData = $result->fetch_assoc();
 $userData['friends'] = json_decode($userData['friends']);
 // add the current user to the requested user's friends list
 array_push($userData['friends'], $_SESSION['id']);
 $userData['friends'] = json_encode($userData['friends']);
 $sql = "UPDATE users SET friends = '".$userData['friends']."' WHERE id = '".$row['id']."'";
 $conn->query($sql);
 $conn->close();

 if ($conn->query($sql) !== TRUE) {
    echo "Error updating friend list: ". $conn->error;
   } else {
 echo "Friend request accepted.";
   }
}