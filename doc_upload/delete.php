<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['delete']) && isset($_POST['doc_num'])) {
    include_once '../includes/dbh.inc.php'; // Include the database connection file

    $doc_num = $_POST['doc_num'];

    // Fetch link associated with the doc_num
    $sql = "SELECT Link FROM Document WHERE Doc_Num = $doc_num";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $link = $row['Link'];

        // Delete file and its parent folder
        if (file_exists($link)) {
            unlink($link); // Delete the file
            rmdir(dirname($link)); // Delete the parent folder
        }

        // Delete entry from the Document table
        $delete_sql = "DELETE FROM Document WHERE Doc_Num = $doc_num";
        mysqli_query($conn, $delete_sql);

        header("Location: index.php?upload_status=Document deleted successfully.");
        exit();
    } else {
        header("Location: index.php?upload_status=Document not found.");
        exit();
    }
} else {
    header("Location: index.php?upload_status=Error deleting document.");
    exit();
}
?>
