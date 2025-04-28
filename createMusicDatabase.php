<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musicDB";

// Create connection (without selecting DB yet)
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create table (optional: genre and release_year are now removed if you want only 3 columns)
$table_sql = "CREATE TABLE IF NOT EXISTS songs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    user_id INT(11) NOT NULL
)";

if ($conn->query($table_sql) === TRUE) {
    echo "Table 'songs' created or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

