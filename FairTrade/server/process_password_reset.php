<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        header("Location: ../forgot_password.php?error=Passwords do not match");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in DB
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../forgot_password.php?success=1");
    } else {
        header("Location: ../forgot_password.php?error=Email not found or password unchanged");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../forgot_password.php?error=Invalid request");
}
