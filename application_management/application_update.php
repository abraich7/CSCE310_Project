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
            <h1>  Edit an Application  </h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="app_id"> Please select an Application to be updated: </label>
                <select name="app_ids" id="app_id">
                    <?php
                    // Get column names from the table
                    $query = "SELECT App_Num FROM applications";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['App_Num'] . "\">" . $row['App_Num'] . "</option>";
                        }
                    }
                    ?>
                </select>

                <br>
                <label for="non_comp"> Update your non-completed certifcation: </label><br>
                <input type="text" id="non_comp" name="non_comp"><br>
                <label for="comp"> Update your completed certifcation: </label><br>
                <input type="text" id="comp" name="comp"><br>
                <label for="purp_state"> Update your Purose Statement: </label><br>
                <input type="text" id="purp_state" name="purp_state"><br>
                <input type="submit" value="Submit">
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $app_id = $_POST["app_ids"];
                    $non_comp = $_POST["non_comp"];
                    $comp = $_POST["comp"];
                    $purp_state = $_POST["purp_state"];

                    $sql = "UPDATE applications SET Uncom_Cert = '$non_comp', Com_Cert = '$comp', Purpose_Statement = '$purp_state' WHERE App_Num = '$app_id'";
                    $conn->query($sql);
                }
            ?>
            <br>
            <button onclick="window.location.href = 'application_manage.php';"> Back </button>
        </div>
    </body>
</html>