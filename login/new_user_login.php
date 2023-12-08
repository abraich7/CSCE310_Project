<!-- New User Creation Form -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>Create a New User</h2>
<form action="new_user_login_function.php" method="post">
    <label for="uin">UIN:</label>
    <input type="text" id="UIN" name="UIN" required><br><br>

    <label for="user_type">User Type:</label>
    <select id="User_Type" name="User_Type" required>
        <option value="admin">admin</option>
        <option value="student">student</option>
        <option value="k-12">k-12</option>
    </select><br><br>


    <label for="first_name">First Name:</label>
    <input type="text" id="First_Name" name="First_Name" required><br><br>

    <label for="m_initial">Middle Initial:</label>
    <input type="text" id="M_Initial" name="M_Initial"><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="Last_Name" name="Last_Name" required><br><br>

    <label for="username">Username:</label>
    <input type="text" id="Username" name="Username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="Passwords" name="Passwords" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="Email" name="Email" required><br><br>

    <label for="discord_name">Discord Name:</label>
    <input type="text" id="Discord_Name" name="Discord_Name"><br><br>

    <input type="submit" name="new_user_login" value="Create User">
</form>

</body>
</html>
