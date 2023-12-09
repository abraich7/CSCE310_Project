<!-- Delete user function -->
<!-- File Completed By: Jacob Parker -->

<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page or display error message
    header("Location: ../login.php"); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $uin_to_delete = $_POST['delete_user'];

    // sets and runs query to get user, for determning user type
    $sql_user = "SELECT * FROM users WHERE UIN = $uin_to_delete";
    $result_user = mysqli_query($conn, $sql_user);
    $row = $result_user->fetch_assoc();

    if ($row['User_Type'] == "student") {
        // if student, have to delete college_student entry first
        $sql_delete_college_student = "DELETE FROM college_student WHERE UIN = $uin_to_delete";
        $result_delete_college_student = mysqli_query($conn, $sql_delete_college_student);
    } 

    // delete entry in users table
    $sql_delete_user = "DELETE FROM users WHERE UIN = $uin_to_delete";
    $result_delete_user = mysqli_query($conn, $sql_delete_user);

    if ($result_delete_user) {
        echo "User deleted successfully.";
        // Redirect to refresh the page after deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request or Event ID not provided.";
}

mysqli_close($conn);
?>