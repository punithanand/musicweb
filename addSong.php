<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized!";
    exit;
}

// Get POST data
$title = $_POST['title'] ?? '';
$artist = $_POST['artist'] ?? '';
$user_id = $_SESSION['user_id'];

// Validate input
if (empty($title) || empty($artist)) {
    echo "Please fill in all fields.";
    exit;
}

// Sanitize input (basic protection)
$title = trim($title);
$artist = trim($artist);

// Database operation
$sql = "INSERT INTO songs (user_id, title, artist) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("iss", $user_id, $title, $artist);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: Could not save song";
    }
    
    $stmt->close();
} else {
    echo "Error: Database problem";
}

$conn->close();
?>
