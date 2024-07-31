<?php

session_start();

if (!$_SESSION['username']) {
    header("Location:./login");
}

?>
<html>
    <head>
        <title>Settings - Eclipse</title>
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
            <div class="settings">
                <div>
                    <div class="nav">
            <button class="btn-primary" onclick="window.history.back()">Go Back</button>
            <h1>Settings</h1>
</div>
            <p>Click on the setting to change it</p>
</div>
            <ul>
                <?php

                // connect to the database
                $conn = new mysqli("localhost", "root", "", "eclipse");
                
                // check connection
                if ($conn->connect_error) {
                    die("Connection failed: ". $conn->connect_error);
                }
                
                // get user settings from the database
                $sql = "SELECT * FROM users WHERE username = '". $_SESSION['username']. "'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<li onclick='changeAvatar()'>Avatar: <img src='". $row["avatar"]. "' alt='avatar' width='40'></li>";
                        echo "<li onclick='changeNickname()'>Nickname: ". $row["nickname"]. "</li>";
                        echo "<li onclick='changeUsername()'>Username: ". $row["username"]. "</li>";
                        echo "<li onclick='changeEmail()'>Email: ". $row["email"]. "</li>";
                        echo "<li onclick='changePassword()'>Password: [not displayed]</li>";
                    }
                }

                // close the connection
                $conn->close();

                ?>
            </ul>
            </div>
        </div>
    </body>
</html>