<?php 
session_start();

// Generate unique verification code

$verificationCode = md5(uniqid(rand(), true));

// connect to database

$conn = new mysqli('localhost', 'root', '', 'eclipse');
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}


// insert verification code into database
$sql = "INSERT INTO `verification_codes`(`code`, `active`) VALUES ('$verificationCode', '1')";
mysqli_query($conn, $sql);

// Send verification email

$currentUrl = "http://$_SERVER[HTTP_HOST]/signup/verify.php";
$verificationLink = $currentUrl . "?code=$verificationCode";

// set smtp server and port

$mailServer = "smtp.gmail.com";
$mailPort = 587;

// set email credentials

$mailUsername = "eclipseappteam@gmail.com";

// get app password variable from mysql
$sql = "SELECT @app_password AS app_password";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$mailPassword = $row['app_password'];

// set smtp server and port using ini

ini_set("SMTPSecure", "tls");
ini_set("smtp.host", $mailServer);
ini_set("smtp.port", $mailPort);

// write email

$to = $_SESSION['email'];
$subject = "Eclipse - Verify your email";
$message = "
Hello ".$_SESSION['username']."!

Please verify your email by clicking the link below:

".$verificationLink."

If you did not request this verification, please ignore this email.

Best regards,
Eclipse Team
";

$headers = "From: Eclipse <no-reply@eclipse.com>\r\n";

mail($to, $subject, $message, $headers);

?>
<html><head>
        <title> Confirm your email - Eclipse</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="app-container">
            <div class="login-container">
                    <div class="step-container">
                       <p class="step-text">Step 2/2</p>
                    </div>
                    <div class="header-group">
                    <h1>Confirm your email</h1>
                    <h3>One last step— Open your inbox and follow the instructions to confirm your email.</h3>

                    </div>
                    <div class="alert">
                     <p class="error-message">We sent the confirmation email to <?php echo $_SESSION['email']; ?>. Not your email? <a href="./login/recovery">Recover your account.</a></p>
                </div>
        </div>
    
</body></html>