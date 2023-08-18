<?php
if(isset($_COOKIE['accuser']))
{
    session_start();
    $_SESSION["user"] = $_COOKIE['accuser'];
    
    echo '<script>window.location.href = "home";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager - Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="login-container">
        <h1 class="login-heading">Account Manager</h1>
        <form action="login" method="POST">
            <div class="input-group">
                <label class="input-label" for="username">Username:</label>
                <input class="input-field" type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label class="input-label" for="password">Password:</label>
                <input class="input-field" type="password" id="password" name="password" required>
            </div>
            <button class="login-button" type="submit">Login</button>
            <p>If this is your first time please <a href="signuppage">signup</button></a></p>
        </form>
    </div>
</body>
</html>
