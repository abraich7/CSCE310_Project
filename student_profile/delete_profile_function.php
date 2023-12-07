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

    if (isset($_POST['delete_account'])) {
        
        $sql = "DELETE FROM users WHERE UIN = $UIN";

        if (mysqli_query($conn, $sql)) {

            header("Location: ../index.php");
            exit();
        } else {
            echo "Error deleting account!";
        }
    }

?>