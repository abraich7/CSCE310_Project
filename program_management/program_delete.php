<?php
    include_once "../includes/dbh.inc.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Program Manager </title>
    </head>
    <body>
        <div> <!-- Admin: delete -->
            <h1> Remove an existing program </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="columns"> Please select a program to be deleted [in format Program Number -- Program Name]</label>
                <select name="column" id="columns">
                    <?php
                    // Get column names from the table
                    $query = "SELECT Program_Num, Name FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {    // build drop down menu of programs
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['Program_Num'] . $row['Name'] . "\">" . $row['Program_Num'] . " -- " . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>

                <button type="submit"> Submit </button><br> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $col_name = $_POST["column"];
                    $Pnum = substr($col_name, 0, 5);
                    $Pname = substr($col_name, 5, strlen($col_name));
                    echo strlen($col_name);
                    echo $Pnum;
                    echo "<br>";
                    echo $Pname;               

                    $sql = "DELETE FROM programs WHERE Program_Num = '$Pnum' AND Name = '$Pname'";
                    $conn->query($sql);
                }
            ?>  
            
            <br>
            <button onclick="window.location.href = 'program_manage.php';"> Back </button> <!-- back to manage page -->
        </div>
    </body>
</html>