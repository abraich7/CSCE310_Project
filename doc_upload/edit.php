<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ..");
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $docNum = $_POST['doc_num'];

    // Fetch document details based on the selected doc_num
    $docQuery = "SELECT * FROM Document WHERE Doc_Num = '$docNum'";
    $docResult = mysqli_query($conn, $docQuery);

    if ($docResult && mysqli_num_rows($docResult) > 0) {
        $docRow = mysqli_fetch_assoc($docResult);
        $appNum = $docRow['App_Num'];
        $docLink = $docRow['Link'];
        
        // Fetch app_num values from the application table for the current user
        $uin = $_SESSION['uin'];
        $appNumQuery = "SELECT app_num FROM applications WHERE UIN = '$uin'";
        $appNumResult = mysqli_query($conn, $appNumQuery);
        $appNumOptions = '';

        if ($appNumResult && mysqli_num_rows($appNumResult) > 0) {
            while ($row = mysqli_fetch_assoc($appNumResult)) {
                $currentAppNum = $row['app_num'];
                $selected = ($currentAppNum == $appNum) ? 'selected' : '';
                $appNumOptions .= "<option value='$currentAppNum' $selected>$currentAppNum</option>";
            }
        }
    } else {
        echo "Document not found.";
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Edit Document</title>
</head>
<body>
    <?php include_once '../includes/navbar.php'; ?>
    
    <h1>Edit Document</h1>

    <form action='update.php' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='doc_num' value='<?php echo $docNum ?>'>
        <label for='app_num'>Select App Num:</label>
        <select name='app_num' id='app_num'>
            <?php echo $appNumOptions ?>
        </select><br><br>
        
        <input type='file' name='document'>
        <input type='submit' name='submit' value='Update Document'>
    </form>

    <a href="index.php">Go Back to Documents</a>
</body>
</html>