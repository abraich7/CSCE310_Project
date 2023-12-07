<?php
session_start();

include_once '../includes/dbh.inc.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['uin'])) {
        // Redirect to login page if not logged in
        header("Location: ..");
        exit();
    }

    $docNum = $_POST['doc_num'];
    $appNum = $_POST['app_num'];

    // Update App_Num without uploading a file
    $sqlUpdateAppNum = "UPDATE Document SET App_Num = ? WHERE Doc_Num = ?";
    $stmt = mysqli_prepare($conn, $sqlUpdateAppNum);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $appNum, $docNum);
        mysqli_stmt_execute($stmt);

        $uploadStatus = "Successfully updated application number";
    } else {
        $uploadStatus = "Sorry, there was an error updating App_Num.";
        header("Location: index.php?upload_status=" . urlencode($uploadStatus));
        exit();
    }

    // Check if a new file is uploaded
    if ($_FILES['document']['size'] > 0) {
        // Directory to store files for each user
        $userDirectory = "uploads/";

        // Fetch the document's current link to delete the old file
        $docQuery = "SELECT Link FROM Document WHERE Doc_Num = '$docNum'";
        $docResult = mysqli_query($conn, $docQuery);
        if ($docResult && mysqli_num_rows($docResult) > 0) {
            $docRow = mysqli_fetch_assoc($docResult);
            $oldLink = $docRow['Link'];
            unlink($oldLink); // Delete the old file
        }

        $targetFile = $userDirectory . $docNum . "/" . basename($_FILES["document"]["name"]);

        // Attempt to upload the new file
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
            // Update document details in the Document table with the new file
            $sqlUpdateDocument = "UPDATE Document SET Link = ?, Doc_Type = ? WHERE Doc_Num = ?";
            $stmt = mysqli_prepare($conn, $sqlUpdateDocument);
            if ($stmt) {
                $docType = $_FILES["document"]["type"]; // This could be used to determine the document type

                mysqli_stmt_bind_param($stmt, "sss", $targetFile, $docType, $docNum);
                mysqli_stmt_execute($stmt);

                $uploadStatus = "The file " . htmlspecialchars(basename($_FILES["document"]["name"])) . " has been updated.";
            } else {
                $uploadStatus = "Sorry, there was an error updating your file.";
            }
        } else {
            $uploadStatus = "Sorry, there was an error uploading your file.";
        }
    }

    header("Location: index.php?upload_status=" . urlencode($uploadStatus));
    exit();
} else {
    // Redirect to index.php if accessed directly
    header("Location: index.php");
    exit();
}
?>
