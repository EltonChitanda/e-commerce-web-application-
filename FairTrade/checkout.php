<?php

session_start();

$total = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
  }
}

$_SESSION['total'] = $total;

if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {
  //let user in


  //send user to home page
} else {

  header('location: index.php');
}

?>

<?php include'layouts/header.php';?>

<head>
<title>Checkout</title>
</head>




  <!-- Checkout -->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="fw-bold">Check Out</h2>
      <hr class="mx-auto" style="width: 60px;">
    </div>

    <div class="container">
      <form id="checkout-form" method="POST" action="server/place_order.php">
        <div class="row">
          <div class="form-group col-md-6 mb-3">
            <label for="checkout-name">Name</label>
            <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
          </div>

          <div class="form-group col-md-6 mb-3">
            <label for="checkout-surname">Surname</label>
            <input type="text" class="form-control" id="checkout-surname" name="surname" placeholder="Surname"
              required />
          </div>

          <div class="form-group col-md-6 mb-3">
            <label for="checkout-email">Email</label>
            <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
          </div>

          <div class="form-group col-md-6 mb-3">
            <label for="checkout-phone">Phone</label>
            <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone Number"
              required />
          </div>

          <div class="form-group col-md-6 mb-3">
            <label for="checkout-city">City</label>
            <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
          </div>

          <div class="form-group col-12 mb-3">
            <label for="checkout-address">Address</label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address"
              required />
          </div>

          <div class="form-group text-end">
            <p>Total amount: R <?php echo number_format($_SESSION['total'], 2); ?></p>
            <input type="submit" class="btn btn-dark px-4" id="checkout-btn" name="place_order" value="Place Order" />
          </div>

        </div>
      </form>
    </div>
  </section>



<?php include'layouts/footer.php';?>