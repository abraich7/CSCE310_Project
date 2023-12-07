<?php
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

$update_status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['event_id']) && isset($_POST['program_name']) && isset($_POST['start_date']) && isset($_POST['start_time']) && isset($_POST['location']) && isset($_POST['end_date']) && isset($_POST['end_time']) && isset($_POST['event_type'])) {
        $event_id = $_POST['event_id'];
        $program_name = $_POST['program_name'];
        $start_date = $_POST['start_date'];
        $start_time = $_POST['start_time'];
        $location = $_POST['location'];
        $end_date = $_POST['end_date'];
        $end_time = $_POST['end_time'];
        $event_type = $_POST['event_type'];

        // Retrieve Program_Num based on the selected Program_Name
        $sql_program = "SELECT Program_Num FROM Programs WHERE Name = '$program_name'";
        $result_program = mysqli_query($conn, $sql_program);

        if ($result_program && mysqli_num_rows($result_program) > 0) {
            $row_program = mysqli_fetch_assoc($result_program);
            $program_num = $row_program['Program_Num'];

            // Update event details in the Event table
            $sql_update_event = "UPDATE Event SET Program_Num = '$program_num', Start_Date = '$start_date', Start_Time = '$start_time', Location = '$location', End_Date = '$end_date', End_Time = '$end_time', Event_Type = '$event_type' WHERE Event_ID = '$event_id'";

            if (mysqli_query($conn, $sql_update_event)) {
                $update_status = 'Event updated successfully!';
                
            } else {
                $update_status = "Error updating event: " . mysqli_error($conn);
            }
        } else {
            $update_status = "Error retrieving Program_Num.";
        }
    } else {
        $update_status = "Invalid parameters.";
    }
} else {
    $update_status = "Invalid request method.";
}

header("Location: edit.php?event_id=$event_id&update_status=$update_status");
exit();

// Close the database connection
mysqli_close($conn);
?>
