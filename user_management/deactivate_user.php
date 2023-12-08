<!-- Deactivate user function -->
<!-- File Completed By: Jacob Parker -->

<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page or display error message
    header("Location: ../login.php"); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deactivate_user'])) {
    // get uin from button thats clicked
    $uin_to_deactivate = $_POST['deactivate_user'];

    // set sql statement
    $sql_deactivate = "UPDATE users SET Account_Active = False WHERE UIN = $uin_to_deactivate";

    // run sql statement
    $result_deactivate = mysqli_query($conn, $sql_deactivate);

    // redirects back to main page if successful, otherwise gives error message
    if ($result_deactivate) {
        echo "User deactivate successfully.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request or Event ID not provided.";
}

mysqli_close($conn);
?>