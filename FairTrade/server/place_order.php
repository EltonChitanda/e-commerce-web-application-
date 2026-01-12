<?php
session_start();
include 'config.php';

if (isset($_POST['place_order'])) {

    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to place an order.");
    }
    $user_id = $_SESSION['user_id'];

    if (!isset($_SESSION['total'])) {
        die("Error: Total amount not set.");
    }
    $total = $_SESSION['total'];

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Error: Your cart is empty.");
    }
    $cart = $_SESSION['cart'];

    $status = 'Pending';

    // Insert order record
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, order_date, status) VALUES (?, ?, NOW(), ?)");
    $stmt->bind_param("ids", $user_id, $total, $status);
    $exec = $stmt->execute();

    if (!$exec) {
        die("Error placing order: " . $stmt->error);
    }

    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items
    $stmt_items = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($cart as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $stmt_items->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $exec_items = $stmt_items->execute();
        if (!$exec_items) {
            die("Error inserting order items: " . $stmt_items->error);
        }
    }
    $stmt_items->close();

    // Save order id and total to session for payment page
    $_SESSION['order_id'] = $order_id;
    $_SESSION['total'] = $total;

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to payment page
    header("Location: ../payment.php");
    exit();
}
?>
