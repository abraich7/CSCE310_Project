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
        <div> <!-- Admin: insert -->
            <h1> Submit a new Application </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="Pnum"> Program number: </label>
                <select name="Pnums" id="Pnum">
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


                <label for="uin"> UIN: </label><br>
                <input type="text" id="uin" name="uin"><br>
                <label for="uncom_cert"> Are you currently enrolled in other uncompleted certifications, if so please list them below: </label><br>
                <input type="text" id="uncom_cert" name="uncom_cert"><br>
                <label for="com_cert"> Have you completed any other industry certifications, if so please list them below: </label><br>
                <input type="text" id="com_cert" name="com_cert"><br>
                <label for="purp_state"> Purpose statement: </label><br>
                <input type="text" id="purp_state" name="purp_state"><br>

                <button type="submit"> Submit </button>
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Program_Num = $_POST["Pnums"];
                    $uin = $_POST["uin"];
                    $uncom_cert = $_POST["uncom_cert"];
                    $com_cert = $_POST["com_cert"];
                    $purp_state = $_POST["purp_state"];
              
                    $sql = "INSERT INTO applications (Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement) VALUES ('$Program_Num', '$uin', '$uncom_cert', '$com_cert', '$purp_state')";
                    $conn->query($sql);
                }
            ?>

            <br>
            <button onclick="window.location.href = 'application_manage.php';"> Back </button>
        </div>
    </body>
</html>