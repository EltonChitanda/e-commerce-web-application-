<?php
$cart_count = 0;
if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/FairTrade/assets/css/style.css">



</head>

<body>

  <!--Navbar-->
  <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/imgs/logo1.png" alt="Logo" class="navbar-logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'products.php' ? 'active' : '' ?>" href="products.php">Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'sellnow.php' ? 'active' : '' ?>" href="sellnow.php">Sell</a>
        </li>

        <li class="nav-item">
          <a class="nav-link position-relative <?= $current_page == 'cart.php' ? 'active' : '' ?>" href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <?php if (!empty($_SESSION['cart'])): ?>
              <span class="cart-badge">
                <?= array_sum(array_column($_SESSION['cart'], 'quantity')) ?>
              </span>
            <?php endif; ?>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'account.php' ? 'active' : '' ?>" href="account.php">
            <i class="fa-regular fa-user"></i>
          </a>
        </li>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <li class="nav-item">
        <a class="nav-link" href="admin/dashboard.php">Admin</a>
    </li>
<?php endif; ?>


      </ul>
    </div>
  </div>
</nav>
