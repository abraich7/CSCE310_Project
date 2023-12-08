<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Links</title>
</head>
<body>
    <h1>Student Links</h1>
    <ul>
        <li><a href ="../application_management/application_manage.php">Application Information Management</a></li> <!-- Jake Student Functionality -->
        <li><a href="../doc_upload">Document Upload</a></li> <!-- Mario Student Functionality -->
        <li><a href ="../student_profile/index.php">Student Profile</a></li> <!-- Jacob Student Functionality -->
        <li><a href ="../program_progress_tracking_student/index_s.php">Track Your Progress</a></li> <!-- Anoop Student Functionality -->
    </ul
</body>
</html>
