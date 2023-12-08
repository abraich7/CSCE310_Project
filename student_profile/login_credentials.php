<!-- Change login credentials page -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
        // Redirect to login page or display error message
        header("Location: login.php"); // Redirect to login page
        exit();
    }

    $UIN = $_SESSION['uin'];

    // set sql query
    $sql = "SELECT * FROM users WHERE UIN = $UIN;";

    // execute sql query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
    }    
?>

<button onclick="window.location.href = 'index.php';">Back</button>
<form action="update_login_credentials.php" method="post">
    <table>
        <tr>
            <td><label for="username">Username:</label></td>
            <td><input type="text" id="username" name="username" value="<?php echo $row['Username']; ?>" required><td>
        </tr>
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" id="password" name="password" value="<?php echo $row['Passwords']; ?>" required><td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="update_login_credentials" value="Update Credentials"></td>
        </tr>
    </table>
</form>