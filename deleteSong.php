<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized!";
    exit;
}

$song_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Verify the song belongs to the user before deleting
$sql = "DELETE FROM songs WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $song_id, $user_id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}
?>
