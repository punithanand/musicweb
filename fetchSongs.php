<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    die(json_encode([]));
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT id, title, artist FROM songs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$songs = [];
while ($row = $result->fetch_assoc()) {
    $songs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($songs);
?>
