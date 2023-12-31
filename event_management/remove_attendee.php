<?php
/**
 * File Completed By: Mario Morelos
 * 
 * This file's purpose is to remove an attendee from an event.
 */
session_start();

// If not admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: .."); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

$event_id = null;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['event_id']) && isset($_POST['attendee_uin'])) {
        $event_id = $_POST['event_id']; // Set event_id from the form submission
        $attendee_uin = $_POST['attendee_uin'];

        // Check if the UIN exists in the Users table
        $sql_check_uin = "SELECT * FROM Users WHERE UIN = '$attendee_uin'";
        $result_uin = mysqli_query($conn, $sql_check_uin);

        if ($result_uin && mysqli_num_rows($result_uin) > 0) {
            // Remove all instances of the attendee's UIN for the corresponding event_id from the event_tracking table
            $sql_remove_attendee = "DELETE FROM event_tracking WHERE Event_ID = '$event_id' AND UIN = '$attendee_uin'";
            if (mysqli_query($conn, $sql_remove_attendee)) {
                echo "Attendee removed successfully.";
            } else {
                echo "Error removing attendee: " . mysqli_error($conn);
            }
        } else {
            $error = "The provided UIN does not exist.";
        }
    } else {
        echo "Invalid parameters.";
    }
} else {
    // Check if event_id is provided in the URL
    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id']; // Set event_id from the URL parameter
    } else {
        echo "<p>No Event ID provided.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Attendee</title>
</head>
<body>
    <h1>Remove Attendee from Event</h1>
    <?php
    if ($error !== '') {
        echo "<p>Error: $error</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="attendee_uin">Attendee UIN:</label>
        <input type="text" id="attendee_uin" name="attendee_uin"><br><br>

        <?php
        echo "<input type='hidden' name='event_id' value='$event_id'>";
        ?>

        <input type="submit" value="Remove Attendee">
    </form>
    <a href="index.php">Go Back to Events</a>
</body>
</html>
