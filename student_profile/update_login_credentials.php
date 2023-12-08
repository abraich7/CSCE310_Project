<!-- Update login credentials function -->
<!-- File Completed By: Jacob Parker -->

<?php
    include_once '../includes/dbh.inc.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update_login_credentials'])) {
            // set username and password from the submitted form
            $uin = $_SESSION["uin"];
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // create SQL statement
            $sql = "UPDATE users 
        SET Username = '$username', 
            Passwords = '$password'
        WHERE uin = $uin;";

            if ($result = mysqli_query($conn, $sql)) {
                header("Location: index.php");
                exit();
                
            } else {
                // user failed to be added
                echo "Sorry, failed to add user";
            }
        }
    }
?>