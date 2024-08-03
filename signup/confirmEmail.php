<?php 
session_start();



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';

$mail = new PHPMailer(true);

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


// get app password variable from mysql
$sql = "SELECT @app_password AS app_password";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$mailPassword = $row['app_password'];



// send email to the user

$subject = "Verify your account - Eclipse";

$message = "
Welcome to Eclipse!

To verify your account, please click the link below:

".$verificationLink."

If you did not request this account to be made, please ignore this email.

Best regards,
Eclipse Team";

// get .env password variable from one dir down

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/..');
$dotenv->load();

$appPassword = $_ENV['password'];

try {
    // Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'eclipseappteam@gmail.com';                 // SMTP username
    $mail->Password   = $appPassword;                  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('eclipseappteam@gmail.com', 'Eclipse Team');
    $mail->addAddress($_SESSION['email'], 'Recipient');     // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

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