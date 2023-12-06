<?php
session_start();

$upload_status = '';

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

// Directory to store files for each user
$user_directory = "uploads/";

// Fetch app_num values from the application table for the current user
$uin = $_SESSION['uin'];
$appNumQuery = "SELECT app_num FROM applications WHERE UIN = '$uin'";
$appNumResult = mysqli_query($conn, $appNumQuery);
$appNumOptions = '';

if ($appNumResult && mysqli_num_rows($appNumResult) > 0) {
    while ($row = mysqli_fetch_assoc($appNumResult)) {
        $appNum = $row['app_num'];
        $appNumOptions .= "<option value='$appNum'>$appNum</option>";
    }
}

// Create user directory if it doesn't exist
if (!file_exists($user_directory)) {
    mkdir($user_directory, 0777, true); // Create directory recursively
}

// Check if the form is submitted and the file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["document"])) {
    $target_file = $user_directory . basename($_FILES["document"]["name"]);

    // Attempt to upload file
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        // File uploaded successfully, now insert details into the database
        $file_name = basename($_FILES["document"]["name"]);
        $doc_type = $_FILES["document"]["type"];

        // Insert document details into the Document table with temp Link
        $sql_insert_document = "INSERT INTO Document (App_Num, Link, Doc_Type) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_insert_document);

        if ($stmt) {
            $app_num = $_POST['app_num'];

            mysqli_stmt_bind_param($stmt, "iss", $app_num, $target_file, $doc_type);
            mysqli_stmt_execute($stmt);

            $doc_num = mysqli_insert_id($conn); // Get the document ID (assuming it's an auto-incremented PK)

            $new_directory = $user_directory . $doc_num . "/";
            mkdir($new_directory, 0777, true); // Create directory with doc_num as its name

            rename($target_file, $new_directory . $file_name); // Move file to the newly created directory
            $upload_status = "The file " . htmlspecialchars($file_name) . " has been uploaded.";

            // Update link to document
            $new_link = $new_directory . "/" . $file_name;
            $sql_replace_link = "UPDATE Document SET Link = '$new_link' WHERE Doc_Num = $doc_num";
            $stmt_replace_link = mysqli_prepare($conn, $sql_replace_link);
            mysqli_stmt_execute($stmt_replace_link);
        } else {
            $upload_status = "Sorry, there was an error uploading your file.";
        }
    } else {
        $upload_status = "Sorry, there was an error uploading your file.";
    }
    header("Location: index.php?upload_status=" . urlencode($upload_status));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Upload and Management</title>
</head>
<body>
    <h1>Document Upload and Management</h1>

    <!-- Form for document upload with dropdown for app_num -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="app_num">Select App Num:</label>
        <select name="app_num" id="app_num">
            <?php echo $appNumOptions; ?>
        </select><br><br>
        
        <input type="file" name="document">
        <input type="submit" name="submit" value="Upload Document">
    </form>

    <a href="index.php">Go Back to Documents</a>
</body>
</html>