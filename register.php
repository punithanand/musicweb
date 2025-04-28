<?php
include "db.php"; // This will use the $conn from db.php

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
  echo "success";
} else {
  echo "Error: " . $conn->error;
}
?>

