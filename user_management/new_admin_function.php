<!-- New admin function -->
<!-- File Completed By: Jacob Parker -->

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['new_admin'])) {
            // set username and password from the submitted form
            $uin = $_POST['UIN'];
            $first_name = $_POST['First_Name'];
            $m_initial = $_POST['M_Initial'];
            $last_name = $_POST['Last_Name'];
            $username = $_POST['Username'];
            $password = $_POST['Passwords'];
            $user_type = $_POST['User_Type'];
            $email = $_POST['Email'];
            $discord_name = $_POST['Discord_Name'];
            $account_active = True;
    
            // create SQL statement
            $sql = "INSERT INTO users(UIN,First_Name,M_Initial,Last_Name,Username,Passwords,User_Type,Email,Discord_Name,Account_Active) VALUES ($uin, '$first_name', '$m_initial', '$last_name', '$username', '$password', '$user_type', '$email', '$discord_name', $account_active)";

            if ($result = mysqli_query($conn, $sql)) {
                // user successfully added
                header("Location: index.php");
                exit();

            } else {
                // user failed to be added
                echo "Sorry, failed to add admin";
            }
        }
    }
?>