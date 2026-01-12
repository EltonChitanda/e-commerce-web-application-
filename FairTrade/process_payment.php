<?php
session_start();
include 'server/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;

    if (!$order_id || !$payment_method) {
        die("Invalid payment data.");
    }

    // Optional: fake validation (like card length etc)
    if ($payment_method === 'card') {
        if (empty($_POST['card_number']) || empty($_POST['card_name']) || empty($_POST['expiry']) || empty($_POST['cvv'])) {
            die("Please fill in all card details.");
        }
    }

    $stmt = $conn->prepare("UPDATE orders SET status = 'Paid', payment_method = ? WHERE id = ?");
    $stmt->bind_param("si", $payment_method, $order_id);

    if ($stmt->execute()) {
        $_SESSION['payment_method'] = $payment_method;
        header("Location: payment_success.php");
        exit();
    } else {
        echo "Error updating order: " . $stmt->error;
    }

} else {
    echo "Invalid request.";
}
?>
