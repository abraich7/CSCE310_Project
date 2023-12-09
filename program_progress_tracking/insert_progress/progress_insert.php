

<!-- Admin Program Progress Functionality: Insert Landing Page
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

    <title>Program Progress: Insert </title> <!-- Choose exactly which program to insert -->
</head>
<body>
    <div>
        <h1> Insert Student Progress </h1>

        <h3> Choose a program </h3>

        <button onclick="window.location.href = 'class_insert.php';"> Insert Class </button><br> <!-- Class -->
        <br>
        <button onclick="window.location.href = 'internship_insert.php';"> Insert Internship </button><br> <!-- Internship -->
        <br>
        <button onclick="window.location.href = 'certification_insert.php';"> Insert Certification </button><br> <!-- Certification -->
        <br>
        <br>

        <button onclick="window.location.href = '../index.php';"> Back </button> <!-- back to insert page -->

    </div>
</body>
</html>