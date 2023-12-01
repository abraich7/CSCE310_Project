<?php
    include_once '../includes/dbh.inc.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['new_user_login'])) {
            // set username and password from the submitted form
            $uin = $_POST['uin'];
            $first_name = $_POST['first_name'];
            $m_initial = $_POST['m_initial'];
            $last_name = $_POST['last_name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_type = "Student";
            $email = $_POST['email'];
            $discord_name = $_POST['discord_name'];


            echo "test";


    
            // Perform validation and login check
            $sql = "INSERT INTO users (uin, first_name, m_initial, last_name, username, passwords, user_type, email, discord_name) VALUES ($uin, $first_name, $m_initial, $last_name, $username, $password, $user_type, $email, $discord_name)";
    
            if ($result = mysqli_query($conn, $sql)) {
                // user successfully added
                echo "User added!";
                exit();
            } else {
                // User failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>