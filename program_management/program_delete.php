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
        <div> <!-- Admin: delete -->
            <h1> Remove an existing program </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="Pnum"> Program Number: </label><br>
                <input type="text" id="Pnum" name="Pnum"><br>
                <label for="Pname"> Program Name: </label><br>
                <input type="text" id="Pname" name="Pname"><br>

                <button type="submit"> Submit </button><br>
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Pnum = $_POST["Pnum"];
                    $Pname = $_POST["Pname"];                

                    $sql = "DELETE FROM programs WHERE Program_Num = '$Pnum' AND Name = '$Pname'";
                    $conn->query($sql);
                }
            ?>  
            
            <br>
            <button onclick="window.location.href = 'program_manage.php';"> Back </button>
        </div>
    </body>
</html>