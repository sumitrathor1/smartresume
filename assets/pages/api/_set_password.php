<?php
session_start(); // Add this at the top
include "../_db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo "invalid";
    exit;
}

if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/', $password)) {
    echo "weak";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Update password and verify user
$stmt = $conn->prepare("UPDATE users SET password = ?, is_verified = 1 WHERE email = ?");
$stmt->bind_param("ss", $hashedPassword, $email);

if ($stmt->execute()) {
    // Remove used token
    $stmt = $conn->prepare("DELETE FROM email_verification WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $_SESSION['success_msg'] = "Your account has been verified. You can now log in.";
    echo "success";
} else {
    echo "error";
}