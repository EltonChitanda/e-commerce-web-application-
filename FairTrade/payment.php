<?php
session_start();

if (!isset($_SESSION['total']) || !isset($_SESSION['order_id'])) {
    echo "No order found. Please go back and place an order.";
    exit();
}

$totalAmount = $_SESSION['total'];
$orderId = $_SESSION['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Secure Payment</title>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />

 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Custom Theme -->
  <style>
    body {
      background-color: #f4f4f4;
      color: #333;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      background-color: #fff;
      border: none;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .btn-custom {
      background-color: #000;
      color: #fff;
    }

    .btn-custom:hover {
      background-color: #333;
    }

    .form-check-label {
      font-weight: 500;
    }

    input::placeholder {
      color: #999;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card w-100" style="max-width: 500px;">
      <h3 class="text-center mb-4"><i class="fas fa-lock me-2 text-dark"></i>Secure Payment</h3>

      <p class="text-center"><strong>Total:</strong> <span class="text-dark fw-bold">R <?php echo number_format($totalAmount, 2); ?></span></p>

      <form action="process_payment.php" method="POST" id="paymentForm">
        <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">

        <!-- Payment Method (Only Card) -->
        <div class="form-check mb-3">
          <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" required checked>
          <label class="form-check-label" for="card">
            <i class="fas fa-credit-card me-1"></i> Credit / Debit Card
          </label>
        </div>

        <!-- Card Fields -->
        <div id="cardDetails">
          <div class="mb-3">
            <input type="text" name="card_number" class="form-control" placeholder="Card Number" required>
          </div>
          <div class="mb-3">
            <input type="text" name="card_name" class="form-control" placeholder="Name on Card" required>
          </div>
          <div class="row">
            <div class="col mb-3">
              <input type="text" name="expiry" class="form-control" placeholder="MM/YY" required>
            </div>
            <div class="col mb-3">
              <input type="text" name="cvv" class="form-control" placeholder="CVV" required>
            </div>
          </div>
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-custom">Pay Now</button>
        </div>
      </form>
    </div>
  </div>

  <?php include 'layouts/footer.php'; ?>
</body>
</html>
