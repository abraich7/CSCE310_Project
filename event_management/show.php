<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to show the specific details of an event.
 * The event details include who is attending the vent.
 */
?>

<?php
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

$event_details = '';
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details using the created view EventDetails based on the provided Event_ID
    $sql = "SELECT * FROM EventDetails WHERE Event_ID = $event_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Display event details including the program name and creator
        $event_details .= "<p><strong>Event ID:</strong> " . $row['Event_ID'] . "</p>";
        $event_details .= "<p><strong>Program Name:</strong> " . $row['Program_Name'] . "</p>";
        $event_details .= "<p><strong>Start Date:</strong> " . $row['Start_Date'] . "</p>";
        $event_details .= "<p><strong>Start Time:</strong> " . $row['Start_Time'] . "</p>";
        $event_details .= "<p><strong>Location:</strong> " . $row['Location'] . "</p>";
        $event_details .= "<p><strong>End Date:</strong> " . $row['End_Date'] . "</p>";
        $event_details .= "<p><strong>End Time:</strong> " . $row['End_Time'] . "</p>";
        $event_details .= "<p><strong>Event Type:</strong> " . $row['Event_Type'] . "</p>";
        $event_details .= "<p><strong>Creator:</strong> " . $row['Creator_Info'] . "</p>";

        // Display attendees of the event
        $event_details .= "<h2>Event Attendees</h2>";
        $event_details .= "<table border='1'>";
        $event_details .= "<tr>
                <th>UIN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                </tr>";

        $sql_attendees = "SELECT * FROM EventTrackingUsers WHERE Event_ID = $event_id";
        $result_attendees = mysqli_query($conn, $sql_attendees);
        
        if ($result_attendees && mysqli_num_rows($result_attendees) > 0) {
            while ($row_attendee = mysqli_fetch_assoc($result_attendees)) {
                $event_details .= "<tr>";
                $event_details .= "<td>" . $row_attendee['UIN'] . "</td>";
                $event_details .= "<td>" . $row_attendee['First_Name'] . "</td>";
                $event_details .= "<td>" . $row_attendee['Last_Name'] . "</td>";
                $event_details .= "<td>" . $row_attendee['Email'] . "</td>";
                $event_details .= "</tr>";
            }
        } else {
            $event_details .= "<tr><td colspan='4'>No attendees found for this event.</td></tr>";
        }

        $event_details .= "</table>";
    } else {
        $event_details .= "<p>No event details found for the provided Event ID.</p>";
    }
} else {
    $event_details .= "<p>No Event ID provided.</p>";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
</head>
<body>
    <h1>Event Details</h1>
    <?php echo $event_details ?>
    
    <a href="index.php">Go Back to Events</a>
</body>
</html>
