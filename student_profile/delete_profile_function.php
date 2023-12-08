<!-- Delete profile function -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    // redirects if not a student
    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
        header("Location: login.php");
        exit();
    }

    $UIN = $_SESSION['uin'];

    if (isset($_POST['delete_account'])) {
        
        // sets sql statement
        $sql = "DELETE FROM users WHERE UIN = $UIN";

        // executes sql statement
        if (mysqli_query($conn, $sql)) {

            header("Location: ../index.php");
            exit();
        } else {
            echo "Error deleting account!";
        }
    }

?>