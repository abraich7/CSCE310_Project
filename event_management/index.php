<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to display all events and have links
 * to the CRUD functionality for each event.
 */
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

// Fetch events with associated program names and creator's information
$sql = "SELECT * FROM EventDetails";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
</head>
<body>
    <?php include_once '../includes/navbar.php'; 

    if (isset($_GET['delete_status'])) {
        echo "<p>" . $_GET['delete_status'] . "</p>";
    }

    if (isset($_GET['create_status'])) {
        echo "<p>" . $_GET['create_status'] . "</p>";
    }

    ?>

    <h1>Event Management System</h1>

    <!-- Link to create a new event -->
    <a href="new.php">Create New Event</a><br><br>

    <!-- Display Events -->
    <h2>Events</h2>
    <table border="1">
        <tr>
            <th>Event ID</th>
            <th>Program Name</th>
            <th>Start Date</th>
            <th>Start Time</th>
            <th>Location</th>
            <th>End Date</th>
            <th>End Time</th>
            <th>Event Type</th>
            <th>Creator</th>
            <th>Details</th>
            <th>Add Attendee</th>
            <th>Remove Attendee</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <!-- PHP code to fetch and display events with creator's information -->
        <?php
        if ($result) {
            // Display fetched events in table rows with links to show details, edit event, and delete event
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Event_ID'] . "</td>";
                echo "<td>" . $row['Program_Name'] . "</td>";
                echo "<td>" . $row['Start_Date'] . "</td>";
                echo "<td>" . $row['Start_Time'] . "</td>";
                echo "<td>" . $row['Location'] . "</td>";
                echo "<td>" . $row['End_Date'] . "</td>";
                echo "<td>" . $row['End_Time'] . "</td>";
                echo "<td>" . $row['Event_Type'] . "</td>";
                echo "<td>" . $row['Creator_Info'] . "</td>";
                echo "<td><a href='show.php?event_id=" . $row['Event_ID'] . "'>View Details</a></td>";
                echo "<td><a href='add_attendee.php?event_id=" . $row['Event_ID'] . "'>Add Attendee</a></td>";
                echo "<td><a href='remove_attendee.php?event_id=" . $row['Event_ID'] . "'>Remove Attendee</a></td>";
                echo "<td><a href='edit.php?event_id=" . $row['Event_ID'] . "'>Edit</a></td>";
                echo "<td>";
                echo "<form action='delete.php' method='post'>";
                echo "<input type='hidden' name='delete_event_id' value='" . $row['Event_ID'] . "'>";
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
