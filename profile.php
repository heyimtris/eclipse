<?php

// get user from url param
$user = $_GET['user'];

// connect to the database

$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// check if user exists

$userQuery = $conn->query("SELECT * FROM users WHERE username='$user'");

if ($userQuery->num_rows == 0) {
    echo "User not found";
    exit;
}

// get user's friends

$userRow = $userQuery->fetch_assoc();

$friends = json_decode($userRow['friends']);

// get amount of friends

$friendCount = count($friends);

?>

<!DOCTYPE html>

<html>
    <head>
        <title>@<?php echo $user ?> - Eclipse</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" type="image/png" href="/Eclipse/icons/eclipseicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="eclipse is a secure & private messaging platform for all. it connects all your friends, family, clubs — everyone’s here." />
        <meta name="keywords" content="eclipse, messaging, chat, group, friends, family, clubs" />
        <meta name="author" content="eclipse team" />
        <meta name="image" content="/Eclipse/icons/eclipseicon.png" />        
    </head>
    <body>
    <div class="app-container">
        <div class="messages">
            <div class="user-container">
               <img class="avatar" src="<?php echo $userRow['avatar']?>" alt="<?php echo $userRow['username']?>'s avatar" width="60">
               <div class="info">
                <h3>@<?php echo $userRow['username']?></h3>
                <p><?php echo $userRow['custom_status']?></p>
                
                <br>
                <h5><?php echo $friendCount ?> friend<?php if ($friendCount > 1) { echo "s"; } ?></h5>
                <p><?php echo $userRow['bio'] ?></p>
                </div>
    
            </div>
        </div>
    </body>
</html>