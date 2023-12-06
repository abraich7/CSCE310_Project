<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
        header("Location: login.php");
        exit();
    }

    $UIN = $_SESSION['uin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Your Account</title>
</head>
<h1>Delete Confirmation</h1>
<body>
    <p>Use this page to delete your account from the website.</p>
    <span>
        <button onclick="window.location.href = 'index.php';">Back</button>
        <form action="delete_profile_function.php" method="post">
            <input type="submit" name="delete_account" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account? This action is permanent and cannot be undone.');">
        </form>
    </span>
</body>
</html>

  