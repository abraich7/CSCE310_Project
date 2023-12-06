
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
    <title>Program Progress: Insert Class</title>
</head>
    <body>
        <div> <!-- Admin: insert -->
            <h1> Record Class Progress </h1>
            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <!--Get user input -->
                <label for = "CE_num"> Class Enrollment Number: </label><br>
                <input type = "text" id="CE_num" name="CE_num"><br>

                <label for = "UIN"> UIN: </label><br>
                <input type = "text" id="UIN" name="UIN"><br>

                <label for = "Class_ID"> Class ID: </label><br>
                <input type = "text" id="Class_ID" name="Class_ID"><br>

                <label for = "Status"> Status: </label><br>
                <input type = "text" id="Status" name="Status"><br>

                <label for = "Semester"> Semester: </label><br>
                <input type = "text" id="Semester" name="Semester"><br>

                <label for = "Pdescrip"> Year: </label><br>
                <input type = "Year" id="Year" name="Year"><br>

                <br>

                <button type="submit"> Submit </button>


            </form>


            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                { 
                    // retrieve user entered values
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
            <button onclick="window.location.href = 'progress_insert.php';"> Back </button> <!-- back to insert page -->


        </div>

    </body>
</html>





