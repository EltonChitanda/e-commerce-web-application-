<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch only necessary fields including 'role'
    $stmt = $conn->prepare("SELECT id, name, surname, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $db_password = $user['password'];
        $password_matches = password_verify($password, $db_password);

        // Allow both hashed and plaintext (during transition)
        if ($password_matches || $password === $db_password) {
            $_SESSION['user_id'] = $user['id'];

            // Store only needed user info in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'email' => $user['email'],
                'role' => $user['role'] ?? 'user'
            ];

            $_SESSION['login_success'] = true;

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../account.php");
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
