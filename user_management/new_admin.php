<!-- New admin page -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
        // Redirect to login page or display error message
        header("Location: login.php"); // Redirect to login page
        exit();
    }   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>Create a New User</h2>
<form action="new_admin_function.php" method="post">
    <label for="uin">UIN:</label>
    <input type="text" id="UIN" name="UIN" required><br><br>

    <label for="user_type">User Type:</label>
    <select id="User_Type" name="User_Type" required>
        <option value="admin">admin</option>
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

    <input type="submit" name="new_admin" value="Create Admin">
</form>
<button onclick="window.location.href = 'index.php';">Cancel</button>


</body>
</html>