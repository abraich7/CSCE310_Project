<?php
    include_once "../includes/dbh.inc.php";
    include_once '../includes/navbar.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Upcoming Events </title>
    </head>
    <body>
        <div> <!-- student: delete -->
            <h1> Upcoming Events </h1>
            <button onclick="window.location.href = '../index.php';">Logout</button> <!-- logout back to index -->
        </div>
    </body>
</html>