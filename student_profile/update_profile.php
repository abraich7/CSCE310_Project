<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['college_student_edit_profile'])) {
            // set username and password from the submitted form
            $uin = $_SESSION["uin"];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $m_initial = $_POST['m_initial'];
            $user_type = $_POST['user_type'];
            $email = $_POST['email'];
            $discord_name = $_POST['discord_name'];

            $gender = $_POST['gender'];
            $hispanic_latino = $_POST['hispanic_latino'];
            $race = $_POST['race'];
            $us_citizen = $_POST['us_citizen'];
            $first_generation = $_POST['first_generation'];
            $dob = $_POST['dob'];
            $gpa = $_POST['gpa'];
            $major = $_POST['major'];
            $minor1 = $_POST['minor1'];
            $minor2 = $_POST['minor2'];
            $expected_graduation = $_POST['expected_graduation'];
            $school = $_POST['school'];
            $classification = $_POST['classification'];
            $phone = $_POST['phone'];
            $student_type = $_POST['student_type'];
    
            // create SQL statement
            $sql = "UPDATE college_student 
        SET Gender = '$gender', 
            Hispanic_Latino = '$hispanic_latino', 
            Race = '$race', 
            US_Citizen = '$us_citizen', 
            First_Generation = '$first_generation', 
            DoB = '$dob', 
            GPA = '$gpa', 
            Major = '$major', 
            Minor_1 = '$minor1', 
            Minor_2 = '$minor2', 
            Expected_Graduation = '$expected_graduation', 
            School = '$school', 
            Classification = '$classification', 
            Phone = '$phone', 
            Student_Type = '$student_type'
        WHERE uin = $uin;";

            $sql_user = "UPDATE users 
        SET First_Name = '$first_name', 
            Last_Name = '$last_name', 
            M_Initial = '$m_initial', 
            User_Type = '$user_type',
            Email = '$email', 
            Discord_Name = '$discord_name'
        WHERE uin = $uin;";

            if ($result = mysqli_query($conn, $sql)) {
                if ($result2 = mysqli_query($conn, $sql_user)) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error!";
                }
                
            } else {
                // user failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>