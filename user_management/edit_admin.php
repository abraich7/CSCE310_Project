<!-- Edit admin page -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is a student
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
        // Redirect to login page or display error message
        header("Location: login.php"); // Redirect to login page
        exit();
    }

    if(isset($_GET['uin'])) {
        $UIN = $_GET['uin'];

        $sql_user = "SELECT * FROM users WHERE UIN = $UIN;";
        $result_user = $conn->query($sql_user);

        if ($result_user->num_rows > 0) {
            $row2 = $result_user->fetch_assoc();
        }    
    } else {
        echo "Error";
    }
?>

<button onclick="window.location.href = 'index.php';">Back</button>
<form action="edit_admin_function.php" method="post">
    <input type="hidden" name="UIN" value="<?php echo $UIN; ?>">
    <table>
        <tr>
            <td><label for="first_name">First Name:</label></td>
            <td><input type="text" id="first_name" name="first_name" value="<?php echo $row2['First_Name']; ?>" required><td>
        </tr>
        <tr>
            <td><label for="m_initial">Middle Initial:</label></td>
            <td><input type="text" id="m_initial" name="m_initial" value="<?php echo $row2['M_Initial']; ?>" required><td>
        </tr>
        <tr>
            <td><label for="last_name">Last Name:</label></td>
            <td><input type="text" id="last_name" name="last_name" value="<?php echo $row2['Last_Name']; ?>" required><td>
        </tr>
        <tr>
            <td><label for="user_type">User Type:</label></td>
            <td><select id="user_type" name="user_type" required>
                    <option value="admin" <?php if ($row2['User_Type'] == 'admin') echo 'selected'; ?>>admin</option>
                    <option value="student" <?php if ($row2['User_Type'] == 'student') echo 'selected'; ?>>student</option>
                    <option value="k-12" <?php if ($row2['User_Type'] == 'k-12') echo 'selected'; ?>>k-12</option>
                </select><td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="text" id="email" name="email" value="<?php echo $row2['Email']; ?>" required><td>
        </tr>
        <tr>
            <td><label for="discord_name">Discord Name:</label></td>
            <td><input type="text" id="discord_name" name="discord_name" value="<?php echo $row2['Discord_Name']; ?>" required><td>
        </tr>
    </table>
        <tr>
            <td colspan="2"><input type="submit" name="admin_edit_profile" value="Update Information"></td>
        </tr>
    </table>
</form>