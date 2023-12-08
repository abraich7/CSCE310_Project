<!-- Student Application Select Functionality-->
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
        <div> <!-- student: select -->
            <h1> Review an Application </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="app_id"> Select the Application you would like to review: </label>
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
              
                    // query for app data
                    $sql = "SELECT * FROM applications WHERE App_Num = '$app_id' AND UIN = '$uin'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // get column info from result
                    $col1 = $row['App_Num'];
                    $col2 = $row['Program_Num'];
                    $col3 = $row['UIN'];
                    $col4 = $row['Uncom_Cert'];
                    $col5 = $row['Com_Cert'];
                    $col6 = $row['Purpose_Statement'];

                    // query for program name
                    $sql = "SELECT Name FROM programs WHERE Program_Num = '$col2'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // get column infor from result
                    $col7 = $row['Name'];


                    // query for status
                    $sql = "SELECT Status FROM Cert_Enrollment WHERE UIN = '$uin' AND Program_Num = '$col2'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // get column info from result
                    $col8 = $row['Status'];
                
                    // print column info
                    echo "<br>";
                    echo "Application Information on File:<br>";
                    echo "UIN: $col3<br>";
                    echo "Application Number: $col1<br>";
                    echo "Program Number: $col2<br>"; 
                    echo "Program Name: $col7<br>";
                    echo "Uncompleted Certification(s): $col4<br>";
                    echo "Completed Certification(s): $col5<br>";
                    echo "Purpose Statement: $col6<br>";
                    echo "Status: $col8<br>";
                }
            ?>
            <br>      
        </div>
    </body>
</html>