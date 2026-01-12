<?php
session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match'); window.location.href='../register.php';</script>";
        exit();
    }

    // Check if password is at least 6 characters
    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long'); window.location.href='../register.php';</script>";
        exit();
    }

    // Check if user already exists
    $check_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_query->bind_param("s", $email);
    $check_query->execute();
    $check_query->store_result();

    if ($check_query->num_rows > 0) {
        echo "<script>alert('Email is already registered'); window.location.href='../register.php';</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into users table
    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful. Please login.'); window.location.href='../login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error registering user'); window.location.href='../register.php';</script>";
        exit();
    }
}
?>
