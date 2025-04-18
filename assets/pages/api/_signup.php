<?php

include "../_db.php"; 

// Get POST data
$name = trim(isset($_POST['name']) ? $_POST['name'] : '');
$email = trim(isset($_POST['email']) ? $_POST['email'] : '');

// Validate input
if ($name === '' || $email === '') {
    echo "invalid";
    exit;
}

// Check if user already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "exists";
    exit;
}

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, email, is_verified, created_at) VALUES (?, ?, 0, NOW())");
$stmt->bind_param("ss", $name, $email);
if ($stmt->execute()) {
    // Generate token
    $token = bin2hex(random_bytes(32));

    // Save token to DB
    $stmt = $conn->prepare("INSERT INTO email_verification (email, token, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    // Send email
    $verification_link = "https://localhost/Resume%20Builder/verify-email.php?token=" . $token;

    include_once "../_mailer.php";
    if (sendVerificationEmail($email, $name, $verification_link)) {
        echo "success";
    } else {
        // Cleanup both user and token if email sending fails

        // Delete from email_verification
        $stmt = $conn->prepare("DELETE FROM email_verification WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Delete from users
        $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        echo "mail_error";
    }

} else {
    echo "error";
}
?>