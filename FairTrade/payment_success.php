<?php
session_start();

$orderId = $_SESSION['order_id'] ?? null;
$total = $_SESSION['total'] ?? null;
$method = $_SESSION['payment_method'] ?? null;

if (!$orderId || !$total || !$method) {
    echo "Payment session expired.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Success - FairTrade</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Custom Style -->
  <style>
    body {
      background-color: #f8f8f8;
      color: #333;
      font-family: 'Segoe UI', sans-serif;
    }

    .success-card {
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      max-width: 600px;
      margin: auto;
      margin-top: 10vh;
      text-align: center;
    }

    .icon-success {
      color: #198754;
      font-size: 48px;
    }

    .order-info p {
      margin: 10px 0;
      font-size: 16px;
    }

    .btn-dark:hover {
      background-color: #333;
    }
  </style>
</head>

<body>
  <div class="success-card">
    <div class="icon-success mb-3">
      <i class="fas fa-check-circle"></i>
    </div>
    <h2 class="mb-3">Payment Successful</h2>
    <p class="lead">Thank you for your order!</p>

    <div class="order-info mt-4">
      <p><strong>Order ID:</strong> <?php echo $orderId; ?></p>
      <p><strong>Total Paid:</strong> R <?php echo number_format($total, 2); ?></p>
      <p><strong>Payment Method:</strong> <?php echo ucfirst($method); ?></p>
      <p><strong>Status:</strong> <span class="text-success fw-bold">Paid</span></p>
    </div>

    <a href="index.php" class="btn btn-dark mt-4"><i class="fas fa-home me-1"></i> Back to Home</a>
  </div>

  <?php
  // Clear session data after displaying success
  unset($_SESSION['order_id']);
  unset($_SESSION['total']);
  unset($_SESSION['payment_method']);

  include 'layouts/footer.php';
  ?>
</body>
</html>
