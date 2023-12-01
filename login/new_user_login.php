<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>Create a New User</h2>
<form action="new_user_login_function.php" method="post">
    <label for="uin">UIN:</label>
    <input type="text" id="uin" name="uin" required><br><br>

    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="m_initial">Middle Initial:</label>
    <input type="text" id="m_initial" name="m_initial"><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="discord_name">Discord Name:</label>
    <input type="text" id="discord_name" name="discord_name"><br><br>

    <input type="submit" name="new_user_login" value="New_User_Login">
</form>

</body>
</html>
