<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
</head>
<body>
    <h1>Event Details</h1>

    <?php
    session_start();

   // If not admin
    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
        header("Location: .."); // Redirect to login page
        exit();
    }

    include_once '../includes/dbh.inc.php'; // Include the database connection file

    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];

        // Fetch event details using the created view EventDetails based on the provided Event_ID
        $sql = "SELECT * FROM EventDetails WHERE Event_ID = $event_id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display event details including the program name and creator
            echo "<p><strong>Event ID:</strong> " . $row['Event_ID'] . "</p>";
            echo "<p><strong>Program Name:</strong> " . $row['Program_Name'] . "</p>";
            echo "<p><strong>Start Date:</strong> " . $row['Start_Date'] . "</p>";
            echo "<p><strong>Start Time:</strong> " . $row['Start_Time'] . "</p>";
            echo "<p><strong>Location:</strong> " . $row['Location'] . "</p>";
            echo "<p><strong>End Date:</strong> " . $row['End_Date'] . "</p>";
            echo "<p><strong>End Time:</strong> " . $row['End_Time'] . "</p>";
            echo "<p><strong>Event Type:</strong> " . $row['Event_Type'] . "</p>";
            echo "<p><strong>Creator:</strong> " . $row['Creator_Info'] . "</p>";

            // Display attendees of the event
            echo "<h2>Event Attendees</h2>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>UIN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                  </tr>";

            $sql_attendees = "SELECT * FROM Attendees WHERE Event_ID = $event_id";
            $result_attendees = mysqli_query($conn, $sql_attendees);

            if ($result_attendees && mysqli_num_rows($result_attendees) > 0) {
                while ($row_attendee = mysqli_fetch_assoc($result_attendees)) {
                    echo "<tr>";
                    echo "<td>" . $row_attendee['UIN'] . "</td>";
                    echo "<td>" . $row_attendee['First_Name'] . "</td>";
                    echo "<td>" . $row_attendee['Last_Name'] . "</td>";
                    echo "<td>" . $row_attendee['Email'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No attendees found for this event.</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No event details found for the provided Event ID.</p>";
        }
    } else {
        echo "<p>No Event ID provided.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <a href="index.php">Go Back to Events</a>
</body>
</html>
