<!-- New Student Creation Function -->
<!-- File Completed By: Jacob Parker -->
<?php
    $uin = $_GET['uin'];
?>

<form action="new_college_student_creation_function.php" method="post">
    <input type="hidden" name="UIN" value="<?php echo $uin; ?>">

    <!-- Gender (VARCHAR) -->
    <label for="gender">Gender:</label>
    <input type="text" id="gender" name="gender" required><br><br>

    <!-- Hispanic/Latino (BINARY) -->
    <label for="hispanic_latino">Hispanic/Latino:</label>
    <select id="hispanic_latino" name="hispanic_latino" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br><br>

    <!-- Race (VARCHAR) -->
    <label for="race">Race:</label>
    <input type="text" id="race" name="race" required><br><br>

    <!-- U.S. Citizen (BINARY) -->
    <label for="us_citizen">U.S. Citizen:</label>
    <select id="us_citizen" name="us_citizen" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br><br>

    <!-- First Generation (BINARY) -->
    <label for="first_generation">First Generation:</label>
    <select id="first_generation" name="first_generation" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br><br>

    <!-- Date of Birth (DATE) -->
    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required><br><br>

    <!-- GPA (FLOAT) -->
    <label for="gpa">GPA:</label>
    <input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4" required><br><br>

    <!-- Major (VARCHAR) -->
    <label for="major">Major:</label>
    <input type="text" id="major" name="major" required><br><br>

    <!-- Minor #1 (VARCHAR) -->
    <label for="minor1">Minor #1:</label>
    <input type="text" id="minor1" name="minor1"><br><br>

    <!-- Minor #2 (VARCHAR) -->
    <label for="minor2">Minor #2:</label>
    <input type="text" id="minor2" name="minor2"><br><br>

    <!-- Expected Graduation (SMALLINT) -->
    <label for="expected_graduation">Expected Graduation:</label>
    <input type="number" id="expected_graduation" name="expected_graduation" min="1900" max="2100" required><br><br>

    <!-- School (VARCHAR) -->
    <label for="school">School:</label>
    <input type="text" id="school" name="school" required><br><br>

    <!-- Classification (VARCHAR) -->
    <label for="classification">Classification:</label>
    <input type="text" id="classification" name="classification" required><br><br>

    <!-- Phone (INT) -->
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>

    <!-- Student Type (VARCHAR) -->
    <label for="student_type">Student Type:</label>
    <input type="text" id="student_type" name="student_type" required><br><br>

    <!-- Submit Button -->
    <input type="submit" name="new_college_student_creation" value="Update Information">
</form>
