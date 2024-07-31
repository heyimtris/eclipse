<html><head>
        <title>Login - Eclipse</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="app-container">
            <div class="login-container">
                    <div class="step-container">
                       <p class="step-text">Step 1/2</p>
                    </div>
                    <div class="header-group">
                    <h1>Sign up for Eclipse</h1>
                    <h3>Join Eclipse and text who you want freely— for free.</h3>

                    <div class="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" id="icon">
  <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
</svg>
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
</svg>

<div class="error-message">This current release of Eclipse is considered a beta version. Things may not work as they seem and bugs are common. If you see one, <a href="#">Contact us</a>!</div>
                    </div>
                    </div>
                    <form action="signup.php" method="post">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email">

                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username">

                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password">

                        <input type="submit" value="Signup">
                    </form>
                    <p>Already have an account? <a href="../login/">Login</a></p>
                </div>
        </div>
    
</body></html>