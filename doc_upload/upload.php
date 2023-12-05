<?php
session_start();

$upload_status = '';

// Check if the user is logged in
if (!isset($_SESSION['uin'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

// Directory to store files for each user
$user_directory = "uploads/" . $_SESSION['uin'] . "/";

// Create user directory if it doesn't exist
if (!file_exists($user_directory)) {
    mkdir($user_directory, 0777, true); // Create directory recursively
}

$target_file = $user_directory . basename($_FILES["document"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  $upload_status = "Sorry, file already exists.";
} else {
  // Attempt to upload file
  if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
    $upload_status = "The file " . htmlspecialchars(basename($_FILES["document"]["name"])) . " has been uploaded.";
    // TODO: ADD TO DB
  } else {
    $upload_status = "Sorry, there was an error uploading your file.";
  }
}

header("Location: index.php?upload_status=$upload_status");
exit();
?>
