<!DOCTYPE html>
<html>
    <head>
        <title>Forgot your password - Eclipse</title>
    </head>
    <body>
        <h1>Forgot your password?</h1>
        <p>No problem! Please enter your email address below and we'll send you a link to reset your password.</p>
        <form action="send_recovery.php" method="POST">
            <input type="email" name="email" placeholder="Email address">
            <button type="submit">Send reset link</button>
        </form>
    </body>
</html>