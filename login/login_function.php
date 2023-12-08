<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login'])) {
            // set username and password from the submitted form
            $username = $_POST['username'];
            $password = $_POST['passwords'];
    
            // Perform validation and login check
            $sql = "SELECT * FROM users WHERE username='$username' AND passwords='$password'";
            $result = mysqli_query($conn, $sql);

            //print_r(mysqli_fetch_assoc($result));
    
            if (mysqli_num_rows($result) == 1) {
                // User exists, login successful
                // Redirect to a success page or perform further actions
                //header("Location: welcome.php");
                $sql_query_for_user_type = "SELECT 'User_Type' FROM users WHERE username='$username'";
                $result_user_type = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result_user_type);



                $_SESSION["uin"] = $row['UIN'];
                $_SESSION["user_type"] = $row['User_Type'];

                if ($_SESSION["user_type"] === 'student') {
                    header("Location: student_links.php");
                    exit();
                } elseif ($_SESSION["user_type"] === 'admin') {
                    header("Location: admin_links.php");
                    exit();
                } elseif ($_SESSION["user_type"] === 'k-12') {
                    header("Location: k12_links.php");
                    exit();
                }
            } else {
                // User doesn't exist or invalid credentials
                // Handle login failure (e.g., display an error message)
                echo "Sorry, invalid username or password.";
            }
        }
    }
?>
