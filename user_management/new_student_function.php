<!-- New User Creation Function -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['new_student'])) {
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
                header("Location: new_college_student_creation.php?uin=" . urlencode($uin));
            } else {
                // user failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>