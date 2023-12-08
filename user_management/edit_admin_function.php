<!-- Edit admin profile update function for admin page -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['admin_edit_profile'])) {
            // set username and password from the submitted form
            $uin = $_POST['UIN'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $m_initial = $_POST['m_initial'];
            $user_type = $_POST['user_type'];
            $email = $_POST['email'];
            $discord_name = $_POST['discord_name'];

            // makes a new college student entry for the user if they are switched to student type from admin type
            if ($user_type == "student") {
                $sql_college_student_check = "SELECT * FROM college_student WHERE UIN = '$uin';";
                $result_college_student_check = mysqli_query($conn, $sql_college_student_check);
        
                if (mysqli_num_rows($result_college_student_check) == 0) {
                    $sql_college_student = "INSERT INTO college_student (UIN) VALUES ($uin)";
                    $result_college_student = mysqli_query($conn, $sql_college_student);
                }


            }

            // set sql query for update
            $sql_user = "UPDATE users 
        SET First_Name = '$first_name', 
            Last_Name = '$last_name', 
            M_Initial = '$m_initial', 
            User_Type = '$user_type',
            Email = '$email', 
            Discord_Name = '$discord_name'
        WHERE uin = $uin;";

            // run sql query and redirect if successful
            if ($result2 = mysqli_query($conn, $sql_user)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error!";
            }
                
        }
    }
?>