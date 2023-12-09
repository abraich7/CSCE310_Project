

<!-- Admin Program Progress Functionality: Insert Internship
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
    <title>Program Progress: Insert Internship </title>
</head>
    <body>
        <div> <!-- Admin: insert -->
            <h1> Record Internship Progress </h1>
            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <!--Get user input -->
                <label for = "IA_num"> Internship Application Number: </label><br>
                <input type = "text" id="IA_num" name="IA_num"><br>

                <br>

                <label for = "UIN"> UIN: </label><br>
                <input type = "text" id="UIN" name="UIN"><br>

                <br>

                <label for = "Intern_ID"> Internship ID: </label><br>
                <input type = "text" id="Intern_ID" name="Intern_ID"><br>

                <br>

                <label for = "Status"> Status: </label><br>
                <select id = "Status" name = "Status">
                    <option value = "Enrolled">Enrolled</option>
                    <option value = "Completed">Completed</option>

                </select>
                <br>
                <!-- <input type = "text" id="Status" name="Status"><br> -->

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
                    $IA_num = $_POST["IA_num"];
                    $UIN = $_POST["UIN"];
                    $Intern_ID = $_POST["Intern_ID"];
                    $Status = $_POST["Status"];
                    $Year = $_POST["Year"];
                              

                    $sql = "INSERT INTO intern_app(IA_Num, UIN, Intern_ID, Status, Year) VALUES ('$IA_num','$UIN','$Intern_ID','$Status','$Year')";

                    $conn->query($sql);

                }
            
            ?>

            <br>
            <br>
            <button onclick="window.location.href = 'progress_insert.php';"> Back </button> <!-- back to insert page -->


        </div>

    </body>
</html>





