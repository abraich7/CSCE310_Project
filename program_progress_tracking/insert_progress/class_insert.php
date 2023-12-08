

<!-- Admin Program Progress Functionality: Insert Class
File Completed By: Anoop Braich -->


<?php
    # linking to database
    include_once '../../includes/dbh.inc.php';
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Program Progress: Insert Class</title>
</head>
    <body>
        <div> <!-- Student: insert -->
        <!-- Read in user inputted values to be put into database -->
            <h1> Record Your Class Progress </h1>
            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <!--Get user input -->
                <label for = "CE_num"> Class Enrollment Number: </label><br>
                <input type = "text" id="CE_num" name="CE_num"><br>

                <br>

                <label for = "UIN"> UIN: </label><br>
                <input type = "text" id="UIN" name="UIN"><br>

                <br>

                <label for = "Class_ID"> Class ID: </label><br>
                <input type = "text" id="Class_ID" name="Class_ID"><br>

                <br>

                <label for = "Status"> Status: </label><br>
                <select id = "Status" name = "Status">
                    <option value = "Enrolled">Enrolled</option>
                    <option value = "Completed">Completed</option>
                    <option value = "Dropped">Dropped</option>

                </select>
                <br>
                <!-- <input type = "text" id="Status" name="Status"><br> -->

                <br>

                <label for = "Semester"> Semester: </label><br>
                <select id = "Semester" name = "Semester">
                    <option value = "Fall">Fall</option>
                    <option value = "Spring">Spring</option>
                    <option value = "Summer">Summer</option>

                </select>
                <br>

                <br>

                <label for = "Year"> Year: </label><br>
                <input type = "Year" id="Year" name="Year"><br>

                <br>

                <button type="submit"> Submit </button>


            </form>


            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                { 
                    // post these variables in the SQL query
                    $CE_num = $_POST["CE_num"];
                    $UIN = $_POST["UIN"];
                    $Class_ID = $_POST["Class_ID"];
                    $Status = $_POST["Status"];
                    $Semester = $_POST["Semester"];
                    $Year = $_POST["Year"];
                              

                    $sql = "INSERT INTO class_enrollment (CE_NUM, UIN, Class_ID, Status, Semester, Year) VALUES ('$CE_num', '$UIN', '$Class_ID', '$Status', '$Semester', '$Year')";

                    $conn->query($sql);

                }
            
            ?>

            <br>
            <br>
            <button onclick="window.location.href = 'progress_insert.php';"> Back </button> <!-- back to insert page -->


        </div>

    </body>
</html>





