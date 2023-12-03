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

                $sql_query_for_user_type = "SELECT 'User_Type' FROM users WHERE username='$username'";
                $result_user_type = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result_user_type);

                $_SESSION["username"] = $username;
                $_SESSION["user_type"] = $row['User_Type'];

                echo $_SESSION["username"];
                echo $_SESSION["user_type"];

                if ($userType === 'student') {
                    header("Location: student_links.php");
                    exit();
                } elseif ($userType === 'admin') {
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