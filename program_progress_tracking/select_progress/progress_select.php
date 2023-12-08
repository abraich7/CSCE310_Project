
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

                // should do for all 3 tables? maybe can do some sort of join to display all results neatly....
                // right now only doing for internship
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

        ?>

        <br>

        <button onclick="window.location.href = '../index.php';"> Back </button> <!-- back to insert page -->

    </div>
</body>
</html>