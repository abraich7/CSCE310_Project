<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

// Check for success parameter in the URL
if (isset($_GET['upload_status'])) {
    echo "<p>" . $_GET['upload_status'] . "</p>";
}

// Fetch and display the uploaded documents for the current user
// Implement logic to retrieve documents from the database and display them in a table or list

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Upload and Management</title>
</head>
<body>
    <?php include_once '../includes/navbar.php'; ?>
    
    <h1>Document Upload and Management</h1>

    <!-- Form for document upload -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="document">
        <input type="submit" name="submit" value="Upload Document">
    </form>

    <h2>Documents</h2>
    <table border="1">
        
    </table>

</body>
</html>
