<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musicDB";

// Create connection with error reporting
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection with detailed error
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed. Check error logs for details.");
}

// Set charset to prevent encoding issues
$conn->set_charset("utf8mb4");
?>
