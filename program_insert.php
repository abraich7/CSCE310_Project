<?php
    include_once "includes/dbh.inc.php";
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
            <h1> Add a new Program </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="Pname"> Program Name: </label><br>
                <input type="text" id="Pname" name="Pname"><br>
                <label for="Pdescrip"> Program Desicription: </label><br>
                <input type="text" id="Pdescrip" name="Pdescrip"><br>

                <button type="submit"> Submit </button>
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Pname = $_POST["Pname"];
                    $Pdescrip = $_POST["Pdescrip"];
              
                    $sql = "INSERT INTO programs (Name, Description) VALUES ('$Pname', '$Pdescrip')";
                    $conn->query($sql);
                }
            ?>

            <br>
            <button onclick="window.location.href = 'program_manage.php';"> Back </button>
        </div>
    </body>
</html>