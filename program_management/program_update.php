<?php
    include_once "../includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Program Manager </title>
    </head>
    <body>
        <div> <!-- Admin: update -->
            <h1>  Update an existing Program  </h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="columns"> Please select a program to be updated</label>
                <select name="column" id="columns">
                    <?php
                    // Get column names from the table
                    $query = "SELECT Program_Num FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['Program_Num'] . "\">" . $row['Program_Num'] . "</option>";
                        }
                    }
                    ?>
                </select>

                <br>
                <label for="NPnum"> Updated Program Number: </label><br>
                <input type="text" id="NPnum" name="NPnum"><br>
                <label for="NPname"> Updated Program Name: </label><br>
                <input type="text" id="NPname" name="NPname"><br>
                <label for="NPdescrip"> Updated Program Description: </label><br>
                <input type="text" id="NPdescrip" name="NPdescrip"><br>
                <input type="submit" value="Submit">
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $col_name = $_POST["column"];
                    $NPnum = $_POST["NPnum"];
                    $NPname = $_POST["NPname"];
                    $NPdescrip = $_POST["NPdescrip"];

                    $sql = "UPDATE Programs SET Program_Num = '$NPnum', Name = '$NPname', Description = '$NPdescrip' WHERE Program_Num = '$col_name'";
                    $conn->query($sql);
                }
            ?>
            <br>
            <button onclick="window.location.href = 'program_manage.php';"> Back </button>
        </div>
    </body>
</html>