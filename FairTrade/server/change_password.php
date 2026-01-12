<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Not logged in";
    exit;
}

$userId = $_SESSION['user_id'];
$newPassword = $_POST['password'] ?? '';

if (empty($newPassword)) {
    echo "Please provide a new password";
    exit;
}

// Save new password (plaintext for now)
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
if ($stmt->execute([$newPassword, $userId])) {
    echo "success";
} else {
    echo "Failed to update password";
}
