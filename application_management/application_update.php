
<!-- Student Application Update Functionality-->
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
        <div> <!-- Student: update -->
            <h1>  Edit an Application  </h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="app_id"> Select the Application you would like to edit: </label>
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

                <!-- text feilds to build the query -->
                <label for="non_comp"> Update your non-completed certifcation: </label><br>
                <input type="text" id="non_comp" name="non_comp"><br>
                <label for="comp"> Update your completed certifcation: </label><br>
                <input type="text" id="comp" name="comp"><br>
                <label for="purp_state"> Update your Purpose Statement: </label><br>
                <input type="text" id="purp_state" name="purp_state"><br>
                
                <button type="submit"> Submit </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query 
                    $app_id = $_POST["app_ids"];
                    $non_comp = $_POST["non_comp"];
                    $comp = $_POST["comp"];
                    $purp_state = $_POST["purp_state"];

                    $sql = "UPDATE applications SET Uncom_Cert = '$non_comp', Com_Cert = '$comp', Purpose_Statement = '$purp_state' WHERE App_Num = '$app_id'";
                    $conn->query($sql);
                }
            ?>
            <br>      
        </div>
    </body>
</html>