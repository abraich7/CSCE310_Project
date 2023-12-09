

<!-- Admin Program Progress Functionality: Select
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

    <title>Program Progress: Select </title> <!-- Access all programs a student is part of using his/her UIN -->
</head>
<body>
    <div>
        <h2> Enter the UIN of the Student (whose progress information you want to access) </h2>

        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <!--Get UIN of student whose records you want to access -->

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

                   // echo "Chosen program is Class.";


                    $sql = "SELECT * FROM class_enrollment WHERE UIN = '$UIN'";
                
                    $result = $conn->query($sql);
    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row in a table
                            echo "<table border = '1' >
                                    <tr>
                                        <th>CE_NUM</th>
                                        <th>UIN</th>
                                        <th>Class_ID</th>
                                        <th>Status</th>
                                        <th>Semester</th>
                                        <th>Year</th>
                                    <tr>";
                            
                            
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr>
                                        <td>" . $row["CE_NUM"] . "</td>
                                        <td>" . $row["UIN"] . "</td>
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



                }



                // if user selects internship as the program
                else if($Program == "Internship")
                {
                    // echo "Chosen program is Internship.";


                    $sql = "SELECT * FROM intern_app WHERE UIN = '$UIN'";
                
                    $result = $conn->query($sql);
    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row
                            echo "<table border = '1' >
                                    <tr>
                                        <th>IA_Num</th>
                                        <th>UIN</th>
                                        <th>Intern_ID</th>
                                        <th>Status</th>
                                        <th>Year</th>
                                    <tr>";
                            
                            
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr>
                                        <td>" . $row["IA_Num"] . "</td>
                                        <td>" . $row["UIN"] . "</td>
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

                }



                // if user selects internship as the program
                else if($Program == "Certification")
                {
                    // echo "Chosen program is Certification.";

                   

                    // $conn->query($createIndexSQL);

                    $sql = "SELECT * FROM cert_enrollment WHERE UIN = '$UIN'";
                
                    $result = $conn->query($sql);
    
                    if($result)
                    {
                        // Check if there are any rows in the result set
                        if($result -> num_rows > 0)
                        {
                            // output data of each row
                            echo "<table border = '1' >
                                    <tr>
                                        <th>CertE_Num</th>
                                        <th>UIN</th>
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
                                        <td>" . $row["UIN"] . "</td>
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


                }




            }

        ?>

        <br>

        <button onclick="window.location.href = '../index.php';"> Back </button> <!-- back to insert page -->

    </div>
</body>
</html>