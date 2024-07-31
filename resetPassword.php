<?php
 
 // connect to database
 $conn = new mysqli('localhost', 'root', '', 'eclipse');
 
 // check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 // get token from url param
 $token = $_GET['token'];

 // check if token exists in the database
 $sql = "SELECT * FROM password_resets WHERE token = '$token'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // get user's email from the token
    $row = $result->fetch_assoc();
    $email = $row['email'];
 } else {
     die("Invalid or expired reset token.");
 }
 ?>

 <!DOCTYPE html>
 <html>
    <head>
        <title>Reset Password - Eclipse</title>
    </head>
    <body>
        <h1>Reset Password</h1>
        <form action="changePassword.php" method="post">
            <input type="hidden" name="email" value="<?php echo $email;?>">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword"><br><br>
            <input type="submit" value="Reset Password">
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>

        
