<?php
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listing_id'])) {
    $listing_id = intval($_POST['listing_id']);

    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized access.");
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $listing_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../account.php?delete=success");
        exit();
    } else {
        die("Error deleting listing: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}

