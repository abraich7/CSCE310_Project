<!-- Admin Program Delete Functionality-->
<!-- File Completed By: Jake Rounds-->


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
            <label for="columns"> Please select a program to be deleted: </label>   // prgram drop down
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

                <label for="delete_type"> Do you want to Archive or Fully Delete this Program?: </label>    // archive or delete functionality
                <select name="delete_type" id="delete_type">
                    <?php
                    $query = "SELECT Name FROM Programs";
                    $result = $conn->query($query);
                        echo "<option value=\"" .  $row['Name'] . "\">" . "Archive" . "</option>";
                        echo "<option value=\"" .  $row['Name'] . "\">" . "Full Delete" . "</option>";
                    ?>
                </select>
                <br>

                <button type="submit"> Submit </button><br> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $type = $_POST["delete_type"];
                    if ($type == 'Archive') {   // check for archieve or delete functionaility
                        $Pname = $_POST["column"];
                        $sql = "DELETE FROM programs WHERE Name = '$Pname'";
                        $conn->query($sql);
                    } else {
                        $Pname = $_POST["column"];
                        $sql = "DELETE FROM programs WHERE Name = '$Pname'";
                        $conn->query($sql);
                    }
                }
            ?>  
            
            <br>
        </div>
    </body>
</html>