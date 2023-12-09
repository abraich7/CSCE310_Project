<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to create an event.
 */
session_start(); // Starting the session

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

// Include the database connection file
include_once '../includes/dbh.inc.php';

$create_status = '';

// Fetch program names from the Programs table
$sql = "SELECT Program_Num, Name FROM Programs";
$result = mysqli_query($conn, $sql);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected program name from the form
    $selected_program_name = $_POST['program_name'];

    // Fetch the associated program number based on the selected program name
    $sql_program = "SELECT Program_Num FROM Programs WHERE Name = '$selected_program_name'";
    $result_program = mysqli_query($conn, $sql_program);

    if ($result_program && mysqli_num_rows($result_program) > 0) {
        $row_program = mysqli_fetch_assoc($result_program);
        $program_num = $row_program['Program_Num']; // Get the program number
        $start_date = $_POST['start_date'];
        $start_time = $_POST['start_time'];
        $location = $_POST['location'];
        $end_date = $_POST['end_date'];
        $end_time = $_POST['end_time'];
        $event_type = $_POST['event_type'];
        $uin = $_SESSION["uin"]; // Get the user's UIN from the session

        // Insert new event into the database
        $sql_insert = "INSERT INTO Event (Program_Num, Start_Date, Start_Time, Location, End_Date, End_Time, Event_Type, UIN) 
                VALUES ('$program_num', '$start_date', '$start_time', '$location', '$end_date', '$end_time', '$event_type', '$uin')";

        if (mysqli_query($conn, $sql_insert)) {
            $create_status = "Event created successfully";
        } else {
            $create_status = "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    } else {
        $create_status = "Error: Could not fetch Program_Num from the selected program name.";
    }
    header("Location: index.php?create_status=$create_status");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Event</title>
</head>
<body>
    <h1>Create New Event</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="program_name">Select Program:</label>
        <select id="program_name" name="program_name">
            <?php
            // Populate dropdown with program names
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                }
            } else {
                echo "<option value=''>No programs available</option>";
            }
            ?>
        </select><br><br>

        <!-- Other form fields -->
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date"><br><br>
        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time"><br><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location"><br><br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"><br><br>
        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time"><br><br>
        <label for="event_type">Event Type:</label>
        <input type="text" id="event_type" name="event_type"><br><br>

        <input type="submit" value="Create Event">
    </form>
    <a href="index.php">Go Back to Events</a>
</body>
</html>
