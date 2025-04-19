<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit;
}

require_once "../_db.php"; 

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT credits FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "credits" => (int)$row['credits']]);
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}