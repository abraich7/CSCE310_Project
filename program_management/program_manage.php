<?php
    include_once "../includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Program Manager </title>
    </head>
    <body>
        <button onclick="window.location.href = 'program_insert.php';"> Add a new Program </button><br>
        <br>
        <button onclick="window.location.href = 'program_update.php';"> Update an existing Program </button><br>
        <br>
        <button onclick="window.location.href = 'program_select.php';"> Generate Program report </button><br>
        <br>
        <button onclick="window.location.href = 'program_delete.php';"> Remove a Program </button><br>
        <br>
        <br>
        <button onclick="window.location.href = '../login/admin_links.php';"> Back </button>
    </body>
</html>