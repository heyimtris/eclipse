<?php

// remove error reports
error_reporting(0);

session_start();

if ($_SESSION['logged_in']) {
if ($_SESSION['logged_in'] == true) {
    header("Location: ../app/index.php");  // Redirect to home page if user is already logged in.
} 
}

?>


<html><head>
        <title>Login - Eclipse</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="app-container">
            <div class="login-container">
                    <img src="/appicons/eclipseicon.png" width="40" alt="Eclipse Logo">
                    <div class="header-group">
                    <h1>Welcome Back!</h1>
                    <h3>Discover the endless possibilities of Eclipse when you log in.</h3>
                    <div class="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" id="icon">
  <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
</svg>
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
</svg>

<div class="error-message">This current release of Eclipse is considered a beta version. Things may not work as they seem and bugs are common. If you see one, <a href="#">Contact us</a>!</div>
                    </div>
                    </div>
                    <form action="login.php" method="post">
                        <label id="emailLabel">Email</label>
                        <label id="usernameLabel" style="display:none;">Username</label>
                        <input type="email" id="email" name="email" placeholder="Email">
                        <input type="text" id="username" name="username" placeholder="Username" style="display: none;">
                        <a onclick="toggleInput()" id="switchText" style="user-select:none;">or sign in with username (doesn't work)</a>

                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password">

                        <div class="group">
                            <div class="remember-me">
                                <input type="checkbox" id="remember-me" name="remember-me">
                                <label for="remember-me">Remember Me (Quick Login)</label>
                            </div>
                            <a href="forgot_password.php">Forgot your password?</a>
                        </div>
                        <input type="submit" value="Login">
                    </form>
                    <p>Don't have an account? <a href="../signup/">Register</a></p>
                </div>
        </div>
        <script>
function toggleInput() {
    var emailInput = document.getElementById('email');
    var usernameInput = document.getElementById('username');
    var emailLabel = document.getElementById('emailLabel');
    var usernameLabel = document.getElementById('usernameLabel');
    var switchText = document.getElementById('switchText');
    if (usernameInput.style.display === 'none') {
        usernameInput.style.display = 'flex';
        usernameLabel.style.display = 'block';
        emailLabel.style.display = 'none';
        emailInput.style.display = 'none';
        switchText.innerHTML = 'or sign in with email';
    } else {
        emailInput.style.display = 'flex';
        emailLabel.style.display = 'block';
        usernameLabel.style.display = 'none';
        usernameInput.style.display = 'none';
        switchText.innerHTML = 'or sign in with username';
    }
}

            if (localStorage.getItem('email') && localStorage.getItem('password')) {
            quickLogin(localStorage.getItem('email'), localStorage.getItem('password'));
            }
            
// Quick Login func.
    function quickLogin($username, $password) {
        <?php
        $conn = new mysqli("localhost", "root", "", "eclipse");
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($password == $row['password']) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['avatar'] = $row['avatar'];
                    $_SESSION['nickname'] = $row['nickname'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['status'] = $row['status'];
                }
            }
        }
        $conn->close();
        
        echo "window.location.href = '../app/index.php';";
    ?>
    }


            </script>
    
</body></html>