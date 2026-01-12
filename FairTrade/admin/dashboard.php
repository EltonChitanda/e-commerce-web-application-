<?php
session_start();
include '../server/config.php';

// Ensure user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Fetch all products
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard - Manage Listings</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Status</th>
                <th>User ID</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td>R<?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['status'] ?? 'Active') ?></td>
                    <td><?= htmlspecialchars($product['user_id']) ?></td>
                    <td><?= htmlspecialchars($product['created_at']) ?></td>
                    <td>
                        <?php if ($product['status'] !== 'Paid'): ?>
                            <form action="mark_paid.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                            </form>
                        <?php endif; ?>
                        <form action="delete_product.php" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
