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

// Fetch doc_num values for the fetched app_num values
$docInfoTable = '<table border="1">
                    <tr>
                        <th>App Num</th>
                        <th>Doc Num</th>
                        <th>Document Name</th>
                        <th>View Document</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>';

// Fetch app_num values from the application table for the current user
$uin = $_SESSION['uin'];
$appNumQuery = "SELECT * FROM doc_uploads_view WHERE UIN = '$uin'";
$appNumResult = mysqli_query($conn, $appNumQuery);

if ($appNumResult && mysqli_num_rows($appNumResult) > 0) {
    while ($row = mysqli_fetch_assoc($appNumResult)) {
        $appNum = $row['App_Num'];
        $docNum = $row['Doc_Num'];

        // Get the file name from the uploads directory associated with the doc_num
        $docDirectory = "uploads/$docNum/";
        $files = scandir($docDirectory);
        $docFileName = isset($files[2]) ? $files[2] : ''; // Assuming the file is at the 2nd index

        $docDirectory = $row['Link'];

        $docInfoTable .= "<tr>
                            <td>$appNum</td>
                            <td>$docNum</td>
                            <td>$docFileName</td>
                            <td><a href='$docDirectory'>View</a></td>
                            <td>
                                <form action='edit.php' method='post'>
                                    <input type='hidden' name='doc_num' value='$docNum'>
                                    <input type='submit' name='edit' value='Edit'>
                                </form>
                            </td>
                            <td>
                                <form action='delete.php' method='post'>
                                    <input type='hidden' name='doc_num' value='$docNum'>
                                    <input type='submit' name='delete' value='Delete'>
                                </form>
                            </td>
                            </tr>";
            
    }
}

$docInfoTable .= '</table>';
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
    <a href="new.php">Upload New Document</a><br><br>

    <h2>Uploaded Documents</h2>
    <?php echo $docInfoTable; ?>

</body>
</html>
