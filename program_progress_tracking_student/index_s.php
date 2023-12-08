
<!-- Student Program Progress Functionality: Landing Page
File Completed By: Anoop Braich -->


<?php
    # linking to database
    include_once '../includes/dbh.inc.php';
    session_start();

    // $_SESSION["UIN"] = 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Program Progress Tracking</title> <!-- Student view - from here you should be able to insert, update, select, and delete as needed -->
</head>
<body>
    <div>
        <h1>Welcome</h1>
        <h2>Student View </h2>

        <!-- CHANGE TO CORRECT FILES -->

        <button onclick="window.location.href = 'insert_progress_student/progress_insert_student.php';"> Record Your Progress </button><br> <!-- Insert -->
        <br>
        <button onclick="window.location.href = 'update_progress_student/progress_update_student.php';"> Edit Your Progress </button><br> <!-- Update -->
        <br>
        <button onclick="window.location.href = 'select_progress_student/progress_select_student.php';"> Access Your Progress Information </button><br> <!-- Select -->
        <br>
        <button onclick="window.location.href = 'delete_progress_student/progress_delete_student.php';"> Remove a Record </button><br> <!-- Delete -->
        <br>
        <br>

        <button onclick="window.location.href = '../login/student_links.php';"> Back </button> <!-- back to insert page -->



    </div>
</body>
</html>


