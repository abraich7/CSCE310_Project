<!-- Student Application Landing Page-->
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
    <title> Application Manager </title> <!-- Student: Application manager page with links to various functionalities -->
</head>
<body>
    <button onclick="window.location.href = 'application_insert.php';"> Submit an Application </button><br> <!-- Student: insert -->
    <br>
    <button onclick="window.location.href = 'application_update.php';"> Edit an Application </button><br> <!-- Student: update -->
    <br>
    <button onclick="window.location.href = 'application_select.php';"> Review an Application </button><br> <!-- Student: select -->
    <br>
    <button onclick="window.location.href = 'application_delete.php';"> Remove an Application </button><br> <!-- Student: delete -->
    <br>
    <br>
</body>
</html>