<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
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
    <title>Admin Links</title>
</head>
<body>
    <p>Admin Links</p>
    <button onclick="window.location.href = '../program_management/program_manage.php';">Program Information Management</button>  <!-- Jake Admin Functionality -->

    <button onclick="window.location.href = '../index.php';">Logout</button>
</body>
</html>