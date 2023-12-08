<!-- Admin Program insert Functionality-->
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
        <div> <!-- Admin: insert -->
            <h1> Add a new Program </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- text feilds to build the query -->
                <label for="Pname"> Program Name: </label><br>
                <input type="text" id="Pname" name="Pname"><br>
                <label for="Pdescrip"> Program Desicription: </label><br>
                <input type="text" id="Pdescrip" name="Pdescrip"><br>

                <button type="submit"> Submit </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") { // get data back from the submit fields and build query
                    $Pname = $_POST["Pname"];
                    $Pdescrip = $_POST["Pdescrip"];
              
                    $sql = "INSERT INTO programs (Name, Description) VALUES ('$Pname', '$Pdescrip')";
                    $conn->query($sql);
                }
            ?>

            <br>
        </div>
    </body>
</html>