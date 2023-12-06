<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
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
    <h1>Admin Links</h1>
    <ul>
        <li><a href="../event_management">Event Management</a></li> <!-- Mario Admin Functionality -->
        <li><a href ="../program_management/program_manage.php">Program Information Management</a></li> <!-- Jake Admin Functionality -->
        <li><a href ="../program_progress_tracking/index.php">Program Progress Tracking</a></li> <!-- Anoop Admin Functionality -->
    </ul>
</body>
</html>
