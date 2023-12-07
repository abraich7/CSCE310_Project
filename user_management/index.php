<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page or display error message
    header("Location: ../login.php"); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

// Fetch events with associated program names and creator's information
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
</head>
<body>
    <?php include_once '../includes/navbar.php'; ?>
    <button onclick="window.location.href = '../login/admin_links.php';">Back</button>
    <h1>User Management System</h1>

    <!-- Link to create a new event -->
    <a href="new_admin.php">Create New Admin</a><br><br>

    <!-- Display Events -->
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
        <!-- PHP code to fetch and display events with creator's information -->
        <?php
        if ($result) {
            // Display fetched events in table rows with links to show details, edit event, and delete event
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['First_Name'] . "</td>";
                echo "<td>" . $row['Last_Name'] . "</td>";
                echo "<td>" . $row['User_Type'] . "</td>";
                echo "<td>" . $row['Account_Active'] . "</td>";
                echo "<td><a href='view_controller.php?uin=" . $row['UIN'] . "'>View</a></td>";
                echo "<td><a href='edit_user.php?uin=" . $row['UIN'] . "'>Edit</a></td>";
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
            echo "<tr><td colspan='14'>No events found.</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>