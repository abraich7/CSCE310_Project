<!-- Student User Authentication and Roles Index Page -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';
    include_once '../includes/navbar.php';

    // confirm user is an admin
    session_start();

    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
        // redirect to login page
        header("Location: login.php");
        exit();
    }

    $UIN = $_SESSION['uin'];

    // sets sql statements
    $sql_college_student = "SELECT * FROM college_student WHERE UIN = $UIN;";
    $sql_user = "SELECT * FROM users WHERE UIN = $UIN;";

    // executes sql statements
    $result_college_student = $conn->query($sql_college_student);
    $result_user = $conn->query($sql_user);

    if ($result_college_student->num_rows > 0) {
        // output data of each row
        $row = $result_college_student->fetch_assoc();
        $row2 = $result_user->fetch_assoc();
    }   
?>

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
        <td><b><label for="phone">Phone:</label></b></td>
        <td><?php echo $row['Phone']; ?></td>
        <td><b><label for="discord_name">Discord Name:</label></b></td>
        <td><?php echo $row2['Discord_Name']; ?></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td><b><label for="gender">Gender:</label></b></td>
        <td><?php echo $row['Gender']; ?></td>
        <td><b><label for="dob">Date of Birth:</label></b></td>
        <td><?php echo $row['DoB']; ?></td>
        <td><b><label for="hispanic_latino">Hispanic/Latino:</label></b></td>
        <td><?php echo ($row['Hispanic_Latino'] == 1) ? 'Yes' : 'No'; ?></td>
        <td><b><label for="race">Race:</label></b></td>
        <td><?php echo $row['Race']; ?></td>
    </tr>

    <tr>
        <td><b><label for="us_citizen">U.S. Citizen:</label></b></td>
        <td><?php echo ($row['US_Citizen'] == 1) ? 'Yes' : 'No'; ?></td>
        <td><b><label for="first_generation">First Generation:</label></b></td>
        <td><?php echo ($row['First_Generation'] == 1) ? 'Yes' : 'No'; ?></td>
    </tr>
    <tr>
        
    </tr>
    <tr>
        
    </tr>
    <tr>
        
    </tr>
    <tr>
        <td><b><label for="gpa">GPA:</label></b></td>
        <td><?php echo $row['GPA']; ?></td>
        <td><b><label for="major">Major:</label></b></td>
        <td><?php echo $row['Major']; ?></td>
        <td><b><label for="minor1">Minor #1:</label></b></td>
        <td><?php echo $row['Minor_1']; ?></td>
        <td><b><label for="minor2">Minor #2:</label></b></td>
        <td><?php echo $row['Minor_2']; ?></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td><b><label for="school">School:</label></b></td>
        <td><?php echo $row['School']; ?></td>
        <td><b><label for="classification">Classification:</label></b></td>
        <td><?php echo $row['Classification']; ?></td>
        <td><b><label for="expected_graduation">Expected Graduation:</label></b></td>
        <td><?php echo $row['Expected_Graduation']; ?></td>
    </tr>
</table>


<ul>
    <li><a href="edit_profile.php">Edit Profile</a></li>
    <li><a href="login_credentials.php">Change Login Credentials</a></li>
    <li><a href="delete_profile.php">Delete Account</a></li>
</ul
