<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = $_POST["userInput"];

    echo "User Input: " . htmlspecialchars($userInput);
}
?>