<?php
    include_once '../includes/dbh.inc.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        <form action="login_function.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <br>
            <div>
                <label for="passwords">Password:</label>
                <input type="password" id="passwords" name="passwords" required>
            </div>
            <div>
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
</body>
</html>