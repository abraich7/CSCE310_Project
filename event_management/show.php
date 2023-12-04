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
    
    include_once '../includes/dbh.inc.php'; // Include the database connection file

    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];

        // Fetch event details with the associated program name and creator's information
        $sql = "SELECT Event.*, Programs.Name AS Program_Name, 
                CONCAT(Users.First_Name, ' ', Users.M_Initial, '. ', Users.Last_Name, ' (', Users.UIN, ')') AS Creator_Info 
                FROM Event 
                LEFT JOIN Programs ON Event.Program_Num = Programs.Program_Num 
                LEFT JOIN Users ON Event.UIN = Users.UIN 
                WHERE Event.Event_ID = $event_id";
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

            // Fetch and display attendees of the event
            $sql_attendees = "SELECT Users.* FROM Users 
                              INNER JOIN Event_Tracking ON Users.UIN = Event_Tracking.UIN 
                              WHERE Event_Tracking.Event_ID = $event_id";
            $result_attendees = mysqli_query($conn, $sql_attendees);

            if ($result_attendees && mysqli_num_rows($result_attendees) > 0) {
                echo "<h2>Event Attendees</h2>";
                echo "<table border='1'>";
                echo "<tr>
                        <th>UIN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                      </tr>";

                while ($row_attendee = mysqli_fetch_assoc($result_attendees)) {
                    echo "<tr>";
                    echo "<td>" . $row_attendee['UIN'] . "</td>";
                    echo "<td>" . $row_attendee['First_Name'] . "</td>";
                    echo "<td>" . $row_attendee['Last_Name'] . "</td>";
                    echo "<td>" . $row_attendee['Email'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No attendees found for this event.</p>";
            }
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
