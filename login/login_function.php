<?php
    include_once '../includes/dbh.inc.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login'])) {
            // set username and password from the submitted form
            $username = $_POST['username'];
            $password = $_POST['passwords'];
    
            // Perform validation and login check
            $sql = "SELECT * FROM users WHERE username='$username' AND passwords='$password'";
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) == 1) {
                // User exists, login successful
                // Redirect to a success page or perform further actions
                // header("Location: welcome.php");
                echo "User found!";
                exit();
            } else {
                // User doesn't exist or invalid credentials
                // Handle login failure (e.g., display an error message)
                echo "Sorry, invalid username or password.";
            }
        }
    }
?>