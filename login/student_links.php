<?php
    include_once '../includes/dbh.inc.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
        // Redirect to login page or display error message
        header("Location: login.php"); // Redirect to login page
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Links</title>
</head>
<body>
    <p>Student Links</p>
    <button onclick="window.location.href = '../application_management/application_manage.php';">Application Information Management</button>  <!-- Jake Student Functionality -->
    
    <button onclick="window.location.href = '../index.php';">Logout</button>  <!-- Jake Admin Functionality -->
</body>
</html>