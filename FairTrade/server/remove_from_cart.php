<?php
session_start();

if (isset($_GET['id'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $_GET['id']) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

header("Location: ../cart.php");
exit();
?>
