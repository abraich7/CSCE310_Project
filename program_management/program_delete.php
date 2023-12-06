<?php
    session_start();
    include_once "../includes/dbh.inc.php";
    include_once '../includes/navbar.php';
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
            <label for="columns"> Please select a program to be deleted [in format Program Name]</label>
                <select name="column" id="columns">
                    <?php
                    // Get column names from the table
                    $query = "SELECT Name FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {    // build drop down menu of programs
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" .  $row['Name'] . "\">" . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>

                <button type="submit"> Submit </button><br> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $Pname = $_POST["column"];
                    $sql = "DELETE FROM programs WHERE Name = '$Pname'";
                    $conn->query($sql);
                }
            ?>  
            
            <br>
        </div>
    </body>
</html>