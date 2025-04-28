<?php
session_start();  // Start the session

// Include database connection
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to check if the user exists
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
  // Check if the password is correct
  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    echo "success";  // Send success response to JavaScript
  } else {
    echo "Wrong password!";  // Send error message if password is wrong
  }
} else {
  echo "User not found!";  // Send error message if user doesn't exist
}


