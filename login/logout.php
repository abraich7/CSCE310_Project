<?php
session_start();

// Unset session variables
unset($_SESSION["uin"]);
unset($_SESSION["user_type"]);

// Redirect to the CSCE310_PROJECT/index.php page after logout
header("Location: ..");
exit();
?>
