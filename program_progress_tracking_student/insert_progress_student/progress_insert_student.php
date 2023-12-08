

<!-- Student Program Progress Functionality: Insert Landing Page
File Completed By: Anoop Braich -->


<?php
    # linking to database
    include_once '../../includes/dbh.inc.php';
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Program Progress: Insert </title> <!-- Choose exactly which program to insert -->
</head>
<body>
    <div>
        <h1> Insert Your Progress </h1>

        <h3> Choose a program to add </h3>

        <button onclick="window.location.href = 'class_insert_student.php';"> Insert Your Class </button><br> <!-- Class -->
        <br>
        <button onclick="window.location.href = 'internship_insert_student.php';"> Insert Your Internship </button><br> <!-- Internship -->
        <br>
        <button onclick="window.location.href = 'certification_insert_student.php';"> Insert Your Certification </button><br> <!-- Certification -->
        <br>
        <br>

        <button onclick="window.location.href = '../index_s.php';"> Back </button> <!-- back to insert page -->

    </div>
</body>
</html>