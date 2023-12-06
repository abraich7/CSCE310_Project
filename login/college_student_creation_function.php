<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['college_student_creation'])) {
            // set username and password from the submitted form
            $uin = $_SESSION["uin"];
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
            $sql = "INSERT INTO college_student (UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor_1, Minor_2, Expected_Graduation, School, Classification, Phone, Student_Type)
            VALUES ('$uin', '$gender', '$hispanic_latino', '$race', '$us_citizen', '$first_generation', '$dob', '$gpa', '$major', '$minor1', '$minor2', '$expected_graduation', '$school', '$classification', '$phone', '$student_type')";

            if ($result = mysqli_query($conn, $sql)) {
                // user successfully added
                header("Location: student_links.php");
                exit();
            } else {
                // user failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>