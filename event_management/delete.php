<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to delete an event.
 */
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

$delete_status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event_id'])) {
    $event_id_to_delete = $_POST['delete_event_id'];

    // Delete associated entries in event_tracking table
    $sql_delete_tracking = "DELETE FROM event_tracking WHERE Event_ID = $event_id_to_delete";
    $result_delete_tracking = mysqli_query($conn, $sql_delete_tracking);

    // Delete the event from the Event table
    $sql_delete_event = "DELETE FROM Event WHERE Event_ID = $event_id_to_delete";
    $result_delete_event = mysqli_query($conn, $sql_delete_event);

    if ($result_delete_tracking && $result_delete_event) {
        $delete_status = "Event and associated tracking entries deleted successfully.";
        
    } else {
        $delete_status = "Error deleting event: " . mysqli_error($conn);
    }
} else {
    $delete_status = "Invalid request or Event ID not provided.";
}

// Redirect to refresh the page after deletion
header("Location: index.php?delete_status=$delete_status");
exit();

mysqli_close($conn);
?>
