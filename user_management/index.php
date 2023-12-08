<!-- Admin User Authentication and Roles Index Page -->
<!-- File Completed By: Jacob Parker -->


<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page or display error message
    header("Location: ../login.php"); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
    <?php include_once '../includes/navbar.php'; ?>
    <button onclick="window.location.href = '../login/admin_links.php';">Back</button>
    <h1>User Management System</h1>

    <a href="new_admin.php">Create New Admin</a><br><br>
    <a href="new_student.php">Create New Student</a><br><br>

    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Type</th>
            <th>Account Active?</th>
            <th>View</th>
            <th>Edit</th>
            <th>Deactivate Account</th>
            <th>Delete Account</th>
        </tr>
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['First_Name'] . "</td>";
                echo "<td>" . $row['Last_Name'] . "</td>";
                echo "<td>" . $row['User_Type'] . "</td>";
                echo "<td>" . $row['Account_Active'] . "</td>";
                echo "<td><a href='view_controller.php?uin=" . $row['UIN'] . "'>View</a></td>";
                echo "<td><a href='edit_user_controller.php?uin=" . $row['UIN'] . "'>Edit</a></td>";
                echo "<td>";
                echo "<form action='deactivate_user.php' method='post'>";
                echo "<input type='hidden' name='deactivate_user' value='" . $row['UIN'] . "'>";
                echo "<input type='submit' value='Deactivate'>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form action='delete_user.php' method='post'>";
                echo "<input type='hidden' name='delete_user' onclick='return confirm('Are you sure you want to delete your account? This action is permanent and cannot be undone.');' value='" . $row['UIN'] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No users found.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>