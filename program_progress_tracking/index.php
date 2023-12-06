
<?php
    # linking to database
    include_once '../includes/dbh.inc.php';
    #sessions?
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Program Progress Tracking</title> <!-- ADMIN view - from here you should be able to insert, update, select, and delete as needed -->
</head>
<body>
    <div>
        <h1>Welcome</h1>
        <h2>Admin View </h2>

        <button onclick="window.location.href = 'insert_progress/progress_insert.php';"> Record Student's Progress </button><br> <!-- Insert -->
        <br>
        <button onclick="window.location.href = 'update_progress/progress_update.php';"> Edit Student's Progress </button><br> <!-- Update -->
        <br>
        <button onclick="window.location.href = 'select_progress/progress_select.php';"> Access Progress Information </button><br> <!-- Select -->
        <br>
        <button onclick="window.location.href = 'delete_progress/progress_delete.php';"> Remove a Report </button><br> <!-- Delete -->
        <br>
        <br>



    </div>
</body>
</html>


