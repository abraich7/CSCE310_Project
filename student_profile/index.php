<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
        // Redirect to login page or display error message
        header("Location: login.php"); // Redirect to login page
        exit();
    }
?>


<ul>
    <li><a href="edit_profile.php">Edit Profile</a></li>
    <li><a href="login_credentials.php">Change Login Credentials</a></li>
    <li><a href="delete_profile.php">Delete Account</a></li>

</ul
