<?php
    include_once "../includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onclick="window.location.href = 'application_insert.php';"> Submit an Application    </button><br>
    <br>
    <button onclick="window.location.href = 'application_update.php';"> Edit an Application </button><br>
    <br>
    <button onclick="window.location.href = 'application_select.php';"> Review an Application </button><br>
    <br>
    <button onclick="window.location.href = 'application_delete.php';"> Remove an Application </button><br>
    <br>
    <br>
    <button onclick="window.location.href = '../login/student_links.php';"> Back </button>
</body>
</html>