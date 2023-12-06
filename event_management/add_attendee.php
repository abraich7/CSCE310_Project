<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page or display error message
    header("Location: ../login.php"); // Redirect to login page
    exit();
}

include_once '../includes/dbh.inc.php'; // Include the database connection file

$event_id = null; // Initialize event_id to null
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['event_id']) && isset($_POST['attendee_uin'])) {
        $event_id = $_POST['event_id']; // Set event_id from the form submission
        $attendee_uin = $_POST['attendee_uin'];

        // Check if the attendee's UIN already exists for the event
        $sql_check_existing = "SELECT * FROM event_tracking WHERE Event_ID = '$event_id' AND UIN = '$attendee_uin'";
        $result_existing = mysqli_query($conn, $sql_check_existing);

        if ($result_existing && mysqli_num_rows($result_existing) > 0) {
            $error = "Attendee with UIN $attendee_uin is already added to this event.";
        } else {
            // Check if the UIN exists in the Users table
            $sql_check_uin = "SELECT * FROM Users WHERE UIN = '$attendee_uin'";
            $result_uin = mysqli_query($conn, $sql_check_uin);

            if ($result_uin && mysqli_num_rows($result_uin) > 0) {
                // Insert UIN and Event ID into event_tracking table
                $sql_insert_tracking = "INSERT INTO event_tracking (Event_ID, UIN) VALUES ('$event_id', '$attendee_uin')";

                if (mysqli_query($conn, $sql_insert_tracking)) {
                    echo "Attendee added successfully.";
                } else {
                    echo "Error adding attendee: " . mysqli_error($conn);
                }
            } else {
                $error = "The provided UIN does not exist.";
            }
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
    <title>Add Attendee</title>
</head>
<body>
    <h1>Add Attendee to Event</h1>
    <?php
    if ($error !== '') {
        echo "<p>Error: $error</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="attendee_uin">Attendee UIN:</label>
        <input type="text" id="attendee_uin" name="attendee_uin"><br><br>

        <!-- Store the event ID as a hidden input field -->
        <?php
        echo "<input type='hidden' name='event_id' value='$event_id'>";
        ?>

        <input type="submit" value="Add Attendee">
    </form>
    <a href="index.php">Go Back to Events</a>
</body>
</html>
