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

        // Fetch user details from the database based on the provided UIN
        $sql = "SELECT * FROM users WHERE UIN = $UIN;";
        $result = $conn->query($sql);

        if(mysqli_num_rows($result) > 0) {
            $row2 = $result->fetch_assoc();
        } else {
            echo "Error";
        }
    } else {
        echo "Error";
    }
?>

<button onclick="window.location.href = '../user_management/index.php';">Back</button>
<h1>Student Profile</h1>
<table>
    <tr>
        <td><b><label for="first_name">First Name:</label></b></td>
        <td><?php echo $row2['First_Name']; ?></td>
        <td><b><label for="m_initial">Middle Initial:</label></b></td>
        <td><?php echo $row2['M_Initial']; ?></td>
        <td><b><label for="last_name">Last Name:</label></b></td>
        <td><?php echo $row2['Last_Name']; ?></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td><b><label for="username">Username:</label></b></td>
        <td><?php echo $row2['Username']; ?></td>
        <td><b><label for="user_type">User Type:</label></b></td>
        <td><?php echo $row2['User_Type']; ?></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td><b><label for="email">Email:</label></b></td>
        <td><?php echo $row2['Email']; ?></td>
        <td><b><label for="discord_name">Discord Name:</label></b></td>
        <td><?php echo $row2['Discord_Name']; ?></td>
    </tr>
</table>