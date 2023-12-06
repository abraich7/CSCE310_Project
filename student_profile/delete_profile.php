<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete_account'])) {
            
            $UIN = $_SESSION['uin']; 
            
            
            // HTML confirmation message
            echo "<h2>Are you sure you want to delete your account?</h2>";
            echo "<p>This action is permanent and cannot be undone.</p>";
            echo "<form method='post'>";
            echo "<input type='submit' name='confirm_delete' value='Delete Account'>";
            echo "<button onclick=\"window.location.href = 'index.php';\">Back</button>";
            echo "</form>";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
                // Run SQL query to delete the user's account
                $sql = "DELETE FROM users WHERE UIN = $uin";
                if (mysqli_query($conn, $sql)) {
                    // Account deleted successfully
                    // Redirect or display a message
                    header("Location: account_deleted.php"); // Redirect to a page indicating account deletion
                    exit();
                } else {
                    // Error in SQL query
                    echo "Error deleting account: " . mysqli_error($conn);
                }
            }
        }
    }
?>

  