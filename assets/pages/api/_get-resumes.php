<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit;
}

require_once "../_db.php";

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, title, created_at FROM resumes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$resumes = [];
while ($row = $result->fetch_assoc()) {
    $resumes[] = [
        "id" => $row['id'],
        "title" => $row['title'],
        "created" => date("Y-m-d", strtotime($row['created_at']))
    ];
}

echo json_encode(["success" => true, "resumes" => $resumes]);