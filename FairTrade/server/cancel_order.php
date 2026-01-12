<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized.");
    }

    $stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $order_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../account.php");
        exit();
    } else {
        die("Error cancelling order: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
