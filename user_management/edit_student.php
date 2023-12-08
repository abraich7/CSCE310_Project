<!-- Edit student page -->
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

        // construct sql statements
        $sql_college_student = "SELECT * FROM college_student WHERE UIN = $UIN;";
        $sql_user = "SELECT * FROM users WHERE UIN = $UIN;";

        // run sql statements
        $result_college_student = $conn->query($sql_college_student);
        $result_user = $conn->query($sql_user);

        if ($result_college_student->num_rows > 0) {
            // get output data by row so we can use it in field below
            $row = $result_college_student->fetch_assoc();
            $row2 = $result_user->fetch_assoc();
        }    
    } else {
        echo "Error";
    }
?>

<button onclick="window.location.href = 'index.php';">Back</button>
<form action="edit_student_function.php" method="post">
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

    <br><br>

    <table>
        <tr>
            <td><label for="gender">Gender:</label></td>
            <td><input type="text" id="gender" name="gender" value="<?php echo $row['Gender']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="hispanic_latino">Hispanic/Latino:</label></td>
            <td>
                <select id="hispanic_latino" name="hispanic_latino" required>
                    <option value="1" <?php if ($row['Hispanic_Latino'] == 1) echo 'selected'; ?>>Yes</option>
                    <option value="0" <?php if ($row['Hispanic_Latino'] == 0) echo 'selected'; ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="race">Race:</label></td>
            <td><input type="text" id="race" name="race" value="<?php echo $row['Race']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="us_citizen">U.S. Citizen:</label></td>
            <td>
                <select id="us_citizen" name="us_citizen" required>
                    <option value="1" <?php if ($row['US_Citizen'] == 1) echo 'selected'; ?>>Yes</option>
                    <option value="0" <?php if ($row['US_Citizen'] == 0) echo 'selected'; ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="first_generation">First Generation:</label></td>
            <td>
                <select id="first_generation" name="first_generation" required>
                    <option value="1" <?php if ($row['First_Generation'] == 1) echo 'selected'; ?>>Yes</option>
                    <option value="0" <?php if ($row['First_Generation'] == 0) echo 'selected'; ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="dob">Date of Birth:</label></td>
            <td><input type="date" id="dob" name="dob" value="<?php echo $row['DoB']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="gpa">GPA:</label></td>
            <td><input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4" value="<?php echo $row['GPA']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="major">Major:</label></td>
            <td><input type="text" id="major" name="major" value="<?php echo $row['Major']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="minor1">Minor #1:</label></td>
            <td><input type="text" id="minor1" name="minor1" value="<?php echo $row['Minor_1']; ?>"></td>
        </tr>
        <tr>
            <td><label for="minor2">Minor #2:</label></td>
            <td><input type="text" id="minor2" name="minor2" value="<?php echo $row['Minor_2']; ?>"></td>
        </tr>
        <tr>
            <td><label for="expected_graduation">Expected Graduation:</label></td>
            <td><input type="number" id="expected_graduation" name="expected_graduation" min="1900" max="2100" value="<?php echo $row['Expected_Graduation']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="school">School:</label></td>
            <td><input type="text" id="school" name="school" value="<?php echo $row['School']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="classification">Classification:</label></td>
            <td><input type="text" id="classification" name="classification" value="<?php echo $row['Classification']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="phone">Phone:</label></td>
            <td><input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="<?php echo $row['Phone']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="student_type">Student Type:</label></td>
            <td><input type="text" id="student_type" name="student_type" value="<?php echo $row['Student_Type']; ?>" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="college_student_edit_profile" value="Update Information"></td>
        </tr>
    </table>
</form>