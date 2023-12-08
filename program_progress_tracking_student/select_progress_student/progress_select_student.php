

<!-- Student Program Progress Functionality: Select
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

    <title>Student Program Progress: Select </title> <!-- Access all programs a student is part of using his/her UIN -->
</head>
<body>
    <div>
        <h2> Enter Your Information Below </h2>

        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <!--Get UIN of this student -->

            <label for = "UIN"> UIN: </label><br>
            <input type = "text" id="UIN" name="UIN"><br>
            <br>

            <label for = "Program"> Select the program you are interested in: </label><br>
             <select id = "Program" name = "Program">
                    <option value = "Class">Class</option>
                    <option value = "Internship">Internship</option>
                    <option value = "Certification">Certification</option>

            </select>

            <br>
            <br>

            <button type="submit"> Submit </button>
            <br>
            <br>
            <br>


        </form>

        
        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            { 
                // retrieve user entered UIN
                $UIN = $_POST["UIN"];

                // stores the value of the program admin is interested in: class, internship, or certification
                $Program = $_POST["Program"];
                

                // if user selects class as the program

                if ($Program == 'Class')
                {


                    // Check if the view exists and drop it if it does
                    $checkViewSQL = "SELECT TABLE_NAME
                                FROM INFORMATION_SCHEMA.TABLES
                                WHERE TABLE_NAME = 'your_classes' AND TABLE_SCHEMA = DATABASE()";
                    $viewExists = $conn->query($checkViewSQL);

                    if ($viewExists && $viewExists->num_rows > 0) {
                        // Drop the view if it exists
                        $dropViewSQL = "DROP VIEW your_classes";
                        $conn->query($dropViewSQL);
                    }

                    //echo "Chosen program is Class.";

                    //$sql = "SELECT * FROM class_enrollment WHERE UIN = '$UIN'";

                    $createViewSQL = "CREATE VIEW your_classes AS
                    SELECT CE_NUM, Class_ID, Status, Semester, Year
                    FROM class_enrollment
                    WHERE UIN = '$UIN'";
    
                    // Execute the query
                    $conn->query($createViewSQL);

                    $selectDataSQL = "SELECT CE_NUM, Class_ID, Status, Semester, Year
                                    FROM your_classes";

                    $result = $conn->query($selectDataSQL);

    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row
                            echo "<table border = '1' >
                                <caption> Your Classes </caption>
                                    <tr>
                                        <th>CE_NUM</th>
                                        <th>Class_ID</th>
                                        <th>Status</th>
                                        <th>Semester</th>
                                        <th>Year</th>
                                    <tr>";
                            
                            
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr>
                                        <td>" . $row["CE_NUM"] . "</td>
                                        <td>" . $row["Class_ID"] . "</td>
                                        <td>" . $row["Status"] . "</td>
                                        <td>" . $row["Semester"] . "</td>
                                        <td>" . $row["Year"] . "</td>
                                <tr>";
    
                                
                            }
    
                            echo "</table>";
                        }
                        
                            
                        // If no corresponding classes to user selected UIN
                        else
                        {
                            echo "0 results";
                        }





                    }



                    // Drop the view after using it
                    $dropViewSQL = "DROP VIEW IF EXISTS your_classes";
                    $conn->query($dropViewSQL);



                }



                // if user selects internship as the program
                else if($Program == "Internship")
                {
                    //echo "Chosen program is Internship.";

                    // program works without this?, but needed it for debugging while other parts of the if statement were not fully functional

                    // Check if the view exists and drop it if it does
                    $checkViewSQL = "SELECT TABLE_NAME
                                FROM INFORMATION_SCHEMA.TABLES
                                WHERE TABLE_NAME = 'your_internships' AND TABLE_SCHEMA = DATABASE()";
                    $viewExists = $conn->query($checkViewSQL);

                    if ($viewExists && $viewExists->num_rows > 0) {
                        // Drop the view if it exists
                        $dropViewSQL = "DROP VIEW your_internships";
                        $conn->query($dropViewSQL);
                    }

                    $createViewSQL = "CREATE VIEW your_internships AS
                    SELECT IA_Num, Intern_ID, Status, Year
                    FROM intern_app
                    WHERE UIN = '$UIN'";
    
                    // Execute the query
                    $conn->query($createViewSQL);

                    $selectDataSQL = "SELECT IA_Num, Intern_ID, Status, Year
                                    FROM your_internships";

                    $result = $conn->query($selectDataSQL);


                    // $sql = "SELECT * FROM intern_app WHERE UIN = '$UIN'";
                
                    // $result = $conn->query($sql);
    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row
                            echo "<table border = '1' >
                                <caption> Your Internships </caption>
                                    <tr>
                                        <th>IA_Num</th>
                                        <th>Intern_ID</th>
                                        <th>Status</th>
                                        <th>Year</th>
                                    <tr>";
                            
                            
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr>
                                        <td>" . $row["IA_Num"] . "</td>
                                        <td>" . $row["Intern_ID"] . "</td>
                                        <td>" . $row["Status"] . "</td>
                                        <td>" . $row["Year"] . "</td>
                                <tr>";
    
                                //echo "IA_Num " . $row["IA_Num"] . " UIN: " . $row["UIN"] . " Intern_ID " . $row["Intern_ID"] . " Status " . $row["Status"] . " Year " . $row["Year"] ."<br>";
                            }
    
                            echo "</table>";
                        }
                        
                            
    
                        else
                        {
                            echo "0 results";
                        }
                    }

                    // Drop the view after using it
                    $dropViewSQL = "DROP VIEW IF EXISTS your_classes";
                    $conn->query($dropViewSQL);
                    


                }



                // if user selects internship as the program
                else if($Program == "Certification")
                {
                    //echo "Chosen program is Certification.";


                    // Check if the view exists and drop it if it does
                    $checkViewSQL = "SELECT TABLE_NAME
                    FROM INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_NAME = 'your_certifications' AND TABLE_SCHEMA = DATABASE()";
                    $viewExists = $conn->query($checkViewSQL);

                    if ($viewExists && $viewExists->num_rows > 0) {
                        // Drop the view if it exists
                        $dropViewSQL = "DROP VIEW your_certifications";
                        $conn->query($dropViewSQL);
                    }

                    $createViewSQL = "CREATE VIEW your_certifications AS
                    SELECT CertE_Num, Cert_ID, Status, Training_Status, Program_Num, Semester, Year
                    FROM cert_enrollment
                    WHERE UIN = '$UIN'";
    
                    // Execute the query
                    $conn->query($createViewSQL);

                    $selectDataSQL = "SELECT CertE_Num, Cert_ID, Status, Training_Status, Program_Num, Semester, Year
                                    FROM your_certifications";

                    $result = $conn->query($selectDataSQL);

    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row
                            echo "<table border = '1' >
                                <caption> Your Certifications </caption>
                                    <tr>
                                        <th>CertE_Num</th>
                                        <th>Cert_ID</th>
                                        <th>Status</th>
                                        <th>Training_Status</th>
                                        <th>Program_Num</th>
                                        <th>Semester</th>
                                        <th>Year</th>
                                    <tr>";
                            
                            
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr>
                                        <td>" . $row["CertE_Num"] . "</td>
                                        <td>" . $row["Cert_ID"] . "</td>
                                        <td>" . $row["Status"] . "</td>
                                        <td>" . $row["Training_Status"] . "</td>
                                        <td>" . $row["Program_Num"] . "</td>
                                        <td>" . $row["Semester"] . "</td>
                                        <td>" . $row["Year"] . "</td>
                                <tr>";
    
                                
                            }
    
                            echo "</table>";
                        }
                        
                            
    
                        else
                        {
                            echo "0 results";
                        }
                    }

                    // Drop the view after using it
                    $dropViewSQL = "DROP VIEW IF EXISTS your_classes";
                    $conn->query($dropViewSQL);


                }




            }

        ?>

        <br>

        <button onclick="window.location.href = '../index_s.php';"> Back </button> <!-- back to insert page -->

    </div>
</body>
</html>