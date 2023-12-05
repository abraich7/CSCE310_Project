<?php
    include_once "../includes/dbh.inc.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Application Manager </title>
    </head>
    <body>
        <div> <!-- student: insert -->
            <h1> Submit a new Application </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="Pnum"> Program number: </label>
                <select name="Pnums" id="Pnum">
                    <?php
                    // get column names from the table
                    $query = "SELECT Program_Num FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {    // build drop down menu of programs
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['Program_Num'] . "\">" . $row['Program_Num'] . "</option>";
                        }
                    }
                    ?>    
                </select>
                <br>

                <!-- text feilds to build the query -->
                <label for="uncom_cert"> Are you currently enrolled in other uncompleted certifications, if so please list them below: </label><br>
                <input type="text" id="uncom_cert" name="uncom_cert"><br>
                <label for="com_cert"> Have you completed any other industry certifications, if so please list them below: </label><br>
                <input type="text" id="com_cert" name="com_cert"><br>
                <label for="purp_state"> Purpose statement: </label><br>
                <input type="text" id="purp_state" name="purp_state"><br>

                <button type="submit"> Submit </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $Program_Num = $_POST["Pnums"];
                    $uin = $_SESSION["uin"];
                    $uncom_cert = $_POST["uncom_cert"];
                    $com_cert = $_POST["com_cert"];
                    $purp_state = $_POST["purp_state"];
              
                    $sql = "INSERT INTO applications (Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement) VALUES ('$Program_Num', '$uin', '$uncom_cert', '$com_cert', '$purp_state')";
                    $conn->query($sql);

                    $sql = "SELECT App_Num FROM applications WHERE Program_Num = '$Program_Num' AND UIN = '$uin'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // get column info from result
                    $column1Value = $row['App_Num'];
                
                    // print column info
                    echo "<br>";
                    echo "Application Number; Please do NOT forget your Application Number: $column1Value<br>";
                }
            ?>
            <br>
            
            <button onclick="window.location.href = 'application_manage.php';"> Back </button> <!-- back to manage page -->
        </div>
    </body>
</html>