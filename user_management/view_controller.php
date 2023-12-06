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

    if(isset($_GET['uin'])) {
        $UIN = $_GET['uin'];

        // Fetch user details from the database based on the provided UIN
        $sql = "SELECT * FROM users WHERE UIN = $UIN;";
        $result = $conn->query($sql);

        if(mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            if($row['User_Type'] == 'student') {
                $url = 'view_student.php?uin=' . $UIN;
                header("Location: $url");
                exit();
            } else {
                $url = 'view_admin.php?uin=' . $UIN;
                header("Location: $url");
                exit();
            }
        } else {
            echo "Error";
        }
    } else {
        echo "Error";
    }
?>