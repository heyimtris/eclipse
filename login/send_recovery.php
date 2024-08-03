<?php

// make it so that it wont log the email thingy, but make it so breaking errors still show



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';

$mail = new PHPMailer(true);

// get all the values from post request
$email = $_POST['email'];

// validate email format

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// generate a unique reset link
$token = bin2hex(random_bytes(16));

// connect to the database

$conn = new mysqli('localhost', 'root', '', 'eclipse');

// check connection

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// check if email exists in the database

$sql = "SELECT * FROM users WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // save the reset token and email to the database

$sql = "INSERT INTO password_resets (email, token) VALUES ('$email', '$token')";

mysqli_query($conn, $sql);

// generate the reset link

$resetLink = "http://$_SERVER[HTTP_HOST]/Eclipse/resetPassword.php?token=$token";


// send email to the user

$subject = "Forgot Password - Eclipse";

$message = "
Hello!

To reset your password, please click the link below:

".$resetLink."

If you did not request this password reset, please ignore this email.

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
    $mail->addAddress($email, 'Recipient');     // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    echo '<img src="/appicons/eclipseicon.png" alt="Eclipse" style="width:40px;height:40;"/>';
    echo 'Reset link has been sent to your email address. Please check your inbox. If you did not receive it, please check your spam folder.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

} else {
    // email does not exist, display error message
    echo "Error: Email not found";
}


?>