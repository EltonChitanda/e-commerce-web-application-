<?php
include('connection.php');

$stmt = $con->prepare("SELECT products.*, users.name AS seller_name, users.surname AS seller_surname 
FROM products 
JOIN users ON products.user_id = users.id 
WHERE category = 'General' AND (status IS NULL OR status != 'Paid') 
ORDER BY created_at DESC");

$stmt->execute();

$recent_items = $stmt->get_result();
?>

