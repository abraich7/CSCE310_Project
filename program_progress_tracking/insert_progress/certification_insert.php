
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
    <title>Program Progress: Insert Certification</title>
</head>
    <body>
        <div> <!-- Admin: insert -->
            <h1> Record Certification Progress </h1>
            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <!--Get user input -->
                <label for = "CertE_num"> Certification Enrollment Number: </label><br>
                <input type = "text" id="CertE_num" name="CertE_num"><br>

                <label for = "UIN"> UIN: </label><br>
                <input type = "text" id="UIN" name="UIN"><br>

                <label for = "Cert_ID"> Certification ID: </label><br>
                <input type = "text" id="Cert_ID" name="Cert_ID"><br>

                <label for = "Status"> Status: </label><br>
                <input type = "text" id="Status" name="Status"><br>

                <label for = "Training_Status"> Training Status: </label><br>
                <input type = "text" id="Training_Status" name="Training_Status"><br>

                <label for = "Program_Num"> Program Number: </label><br>
                <input type = "text" id="Program_Num" name="Program_Num"><br>

                <label for = "Semester"> Semester: </label><br>
                <input type = "text" id="Semester" name="Semester"><br>

                <label for = "Year"> Year: </label><br>
                <input type = "Year" id="Year" name="Year"><br>

                <br>

                <button type="submit"> Submit </button>


            </form>


            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                { 
                    // retrieve user entered values
                    $CertE_num = $_POST["CertE_num"];
                    $UIN = $_POST["UIN"];
                    $Cert_ID = $_POST["Cert_ID"];
                    $Status = $_POST["Status"];
                    $Training_Status = $_POST["Training_Status"];
                    $Program_Num = $_POST["Program_Num"];
                    $Semester = $_POST["Semester"];
                    $Year = $_POST["Year"];
                              

                    $sql = "INSERT INTO cert_enrollment (CertE_Num, UIN, Cert_ID, Status, Training_Status, Program_Num, Semester, Year) VALUES ('$CertE_num','$UIN','$Cert_ID','$Status','$Training_Status','$Program_Num','$Semester','$Year')";
                    //

                    $conn->query($sql);

                }
            
            ?>

            <br>
            <button onclick="window.location.href = 'progress_insert.php';"> Back </button> <!-- back to insert page -->


        </div>

    </body>
</html>





