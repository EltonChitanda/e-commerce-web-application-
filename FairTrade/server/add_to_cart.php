<?php
session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    die("You must be logged in to add items to your cart. <a href='../login.php'>Login here</a>.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_POST["product_image"];
    $quantity = isset($_POST["quantity"]) ? intval($_POST["quantity"]) : 1;

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $found = false;
    foreach ($_SESSION["cart"] as &$item) {
        if ($item["id"] == $product_id) {
            $item["quantity"] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION["cart"][] = [
            "id" => $product_id,
            "name" => $product_name,
            "price" => $product_price,
            "image" => $product_image,
            "quantity" => $quantity
        ];
    }

    
    $_SESSION['cart_message'] = "Added '{$product_name}' to your cart!";

    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Invalid Request!";
}
?>
