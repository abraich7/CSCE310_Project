<!-- Student Application Delete Functionality-->
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
        <title> Application Manager </title>
    </head>
    <body>
        <div> <!-- student: delete -->
            <h1> Delete an Application </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- text feilds to build the query -->
                <label for="app_id"> Select the Application you would like to delete: </label>  // program select drop down
                <select name="app_ids" id="app_id">
                    <?php
                    // get column names from the table
                    $curr_user_uin = $_SESSION["uin"];
                    $query = "SELECT App_Num, UIN FROM applications WHERE UIN = '$curr_user_uin'";
                    $result = $conn->query($query);

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['App_Num'] . "\">" . $row['App_Num']  . "</option>";
                    }

                    ?>
                </select>
                <br>

                <button type="submit"> Submit </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query 
                    $uin = $_SESSION["uin"];
                    $app_id = $_POST["app_ids"];
              
                    $sql = "DELETE FROM applications WHERE App_Num = '$app_id' AND UIN = '$uin'";
                    $conn->query($sql);
                }
            ?>
            <br>         
        </div>
    </body>
</html>