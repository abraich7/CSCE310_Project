<?php
include_once '../includes/dbh.inc.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event_id'])) {
    $event_id_to_delete = $_POST['delete_event_id'];

    // Delete associated entries in event_tracking table
    $sql_delete_tracking = "DELETE FROM event_tracking WHERE Event_ID = $event_id_to_delete";
    $result_delete_tracking = mysqli_query($conn, $sql_delete_tracking);

    // Delete the event from the Event table
    $sql_delete_event = "DELETE FROM Event WHERE Event_ID = $event_id_to_delete";
    $result_delete_event = mysqli_query($conn, $sql_delete_event);

    if ($result_delete_tracking && $result_delete_event) {
        echo "Event and associated tracking entries deleted successfully.";
        // Redirect to refresh the page after deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request or Event ID not provided.";
}

mysqli_close($conn);
?>
