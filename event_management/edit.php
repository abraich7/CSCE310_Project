<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to display the form details for editing an event
 * and passing the parameters to update.php
 */
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>

    <?php
    // Check for success parameter in the URL
    if (isset($_GET['update_status'])) {
        echo "<p>" . $_GET['update_status'] . "</p>";
    }

    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];
    
        // Fetch event details using the created view EventDetails based on the provided Event_ID
        $sql = "SELECT * FROM EventDetails WHERE Event_ID = $event_id";
        $result = mysqli_query($conn, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <form action='update.php' method='post'>
                <input type='hidden' name='event_id' value='<?php echo $row['Event_ID']; ?>'>
    
                <label for='program_name'>Program Name:</label>
                <select id='program_name' name='program_name'>
                    <?php
                    $selected_program_name = $row['Program_Name'];
                    $sql_programs = "SELECT Name FROM Programs";
                    $result_programs = mysqli_query($conn, $sql_programs);
    
                    if ($result_programs && mysqli_num_rows($result_programs) > 0) {
                        while ($program = mysqli_fetch_assoc($result_programs)) {
                            $selected = ($program['Name'] === $selected_program_name) ? 'selected' : '';
                            echo "<option value='" . $program['Name'] . "' $selected>" . $program['Name'] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>
    
                <label for='start_date'>Start Date:</label>
                <input type='date' id='start_date' name='start_date' value='<?php echo $row['Start_Date']; ?>'><br><br>

                <label for='start_time'>Start Time:</label>
                <input type='time' id='start_time' name='start_time' value='<?php echo $row['Start_Time']; ?>'><br><br>

                <label for='location'>Location:</label>
                <input type='text' id='location' name='location' value='<?php echo $row['Location']; ?>'><br><br>

                <label for='end_date'>End Date:</label>
                <input type='date' id='end_date' name='end_date' value='<?php echo $row['End_Date']; ?>'><br><br>

                <label for='end_time'>End Time:</label>
                <input type='time' id='end_time' name='end_time' value='<?php echo $row['End_Time']; ?>'><br><br>

                <label for='event_type'>Event Type:</label>
                <input type='text' id='event_type' name='event_type' value='<?php echo $row['Event_Type']; ?>'><br><br>

                <input type='submit' value='Update Event'>
            </form>
    <?php
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
