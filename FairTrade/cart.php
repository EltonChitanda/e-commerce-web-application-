<?php
session_start();
?>

<?php include'layouts/header.php';?>

<head>
<title>Cart</title>
</head>

  <!--Cart-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="mb-5">Your Cart</h2>
      <hr>
    </div>

    <table class="mt-5 pt-5">
      <?php
      $total = 0;
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        ?>
        <!-- Table Headings -->
        <thead>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <tr>
              <td>
                <div class="product-info">
                  <img src="assets/imgs/<?php echo $item['image']; ?>" />
                  <div>
                    <p><?php echo htmlspecialchars($item['name']); ?></p>
                    <small><span>R</span><?php echo number_format($item['price'], 2); ?></small><br>
                    <a class="remove-btn" href="server/remove_from_cart.php?id=<?php echo $item['id']; ?>">Remove</a>
                  </div>
                </div>
              </td>
              <td>
                <input type="number" value="<?php echo $item['quantity']; ?>" disabled />
              </td>
              <td>
                <span>R</span>
                <span class="product-price"><?php echo number_format($subtotal, 2); ?></span>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
        <?php
      } else {
        echo "<tr><td colspan='3'>Your cart is empty.</td></tr>";
      }
      ?>
    </table>


    </table>


    <div class="cart-total">
      <table>
        <tr>
          <td>Subtotal</td>
          <td>R<?php echo number_format($total, 2); ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td>R<?php echo number_format($total, 2); ?></td>
        </tr>


      </table>
    </div>



    <div class="checkout-container">
      <form method="POST" action="checkout.php">
        <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
      </form>

    </div>




  </section>





<?php include'layouts/footer.php';?>