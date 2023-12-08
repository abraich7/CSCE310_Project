<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to delete an uploaded file.
 */
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ..");
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
            unlink($link);
            rmdir(dirname($link));
        }

        // Delete entry from the Document table
        $delete_sql = "DELETE FROM Document WHERE Doc_Num = $doc_num";
        mysqli_query($conn, $delete_sql);

        $upload_status = "Document deleted successfully";
    } else {
        $upload_status = "Document not found";
    }
    header("Location: index.php?upload_status=$upload_status");
    exit();
} else {
    // Redirect to index.php if accessed directly
    header("Location: index.php");
    exit();
}
?>
