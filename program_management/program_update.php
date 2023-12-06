// Admin Program Update Functionality
// File Completed By: Jake Rounds

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
        <div> <!-- Admin: update -->
            <h1>  Update an existing Program  </h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="columns"> Please select a program to be updated [in format Program Number -- Program Name]</label>
                <select name="column" id="columns">
                    <?php
                    // Get column names from the table
                    $query = "SELECT Name FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {    // build drop down menu of programs
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['Name'] . "\">" . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>

                <!-- text feilds to build the query -->
                <label for="NPname"> Updated Program Name: </label><br>
                <input type="text" id="NPname" name="NPname"><br>
                <label for="NPdescrip"> Updated Program Description: </label><br>
                <input type="text" id="NPdescrip" name="NPdescrip"><br>
                <button type="submit"> Submit </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $Program_Name = $_POST["column"];
                    $NPname = $_POST["NPname"];
                    $NPdescrip = $_POST["NPdescrip"];

                    $sql = "UPDATE Programs SET Name = '$NPname', Description = '$NPdescrip' WHERE Name = '$Program_Name'";
                    $conn->query($sql);
                }
            ?>
            <br>
        </div>
    </body>
</html>