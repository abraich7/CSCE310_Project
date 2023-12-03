<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['new_user_login'])) {
            // set username and password from the submitted form
            $uin = $_POST['UIN'];
            $first_name = $_POST['First_Name'];
            $m_initial = $_POST['M_Initial'];
            $last_name = $_POST['Last_Name'];
            $username = $_POST['Username'];
            $password = $_POST['Passwords'];
            $user_type = "Student";
            $email = $_POST['Email'];
            $discord_name = $_POST['Discord_Name'];
    
            // create SQL statement
            $sql = "INSERT INTO users(UIN,First_Name,M_Initial,Last_Name,Username,Passwords,User_Type,Email,Discord_Name) VALUES ($uin, '$first_name', '$m_initial', '$last_name', '$username', '$password', '$user_type', '$email', '$discord_name')";

    
            if ($result = mysqli_query($conn, $sql)) {
                // user successfully added


                $_SESSION["uin"] = $uin;
                $_SESSION["user_type"] = $user_type;

                echo $_SESSION["uin"];
                echo $_SESSION["user_type"];

                if ($_SESSION["user_type"] === 'student') {
                    header("Location: student_links.php");
                    exit();
                } elseif ($_SESSION["user_type"] === 'admin') {
                    header("Location: admin_links.php");
                    exit();
                }
            } else {
                // user failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>