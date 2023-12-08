<!-- Admin Program Landing Page-->
<!-- File Completed By: Jake Rounds-->

<?php
    session_start();
    include_once "../includes/dbh.inc.php";
    include_once '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Program Manager </title> <!-- Admin: program manager page with links to various functionalities -->
    </head>
    <body>
        <button onclick="window.location.href = 'program_insert.php';"> Add a new Program </button><br> <!-- Admin: insert -->
        <br>
        <button onclick="window.location.href = 'program_update.php';"> Update an existing Program </button><br> <!-- Admin: update -->
        <br>
        <button onclick="window.location.href = 'program_select.php';"> Generate Program report </button><br> <!-- Admin: select -->
        <br>
        <button onclick="window.location.href = 'program_delete.php';"> Remove a Program </button><br> <!-- Admin: delete -->
        <br>
        <br>
    </body>
</html>