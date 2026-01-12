<?php
session_start();
if (isset($_SESSION['cart_message'])) {
  echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
      ' . htmlspecialchars($_SESSION['cart_message']) . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  unset($_SESSION['cart_message']);
}
?>

<?php include'layouts/header.php';?>

<head>
<title>Products</title>
</head>



  <!--Recently Listed-->
  <section id="recent-items" class="py-5">
    <div class="container">
      <h2 class="mb-5">Recently Listed</h2>

      <div class="row">
        <?php include('server/get_recent_items.php'); ?>

        <?php while ($row = $recent_items->fetch_assoc()) { ?>


        <!-- Product Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
          <div class="product-card" style="cursor: pointer;">
            <div class="product-image-container" data-bs-toggle="modal"
              data-bs-target="#productModal<?php echo $row['id']; ?>"
              style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
              <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="product-image"
                alt="<?php echo htmlspecialchars($row['name']); ?>"
                style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
            <div class="product-details p-3">
              <h5 class="product-title" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['name']); ?>
              </h5>
              <p class="product-price mb-1" data-bs-toggle="modal"
                data-bs-target="#productModal<?php echo $row['id']; ?>">
                R
                <?php echo number_format($row['price'], 2); ?>
              </p>
              <p class="product-location text-muted">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($row['location']); ?>
              </p>
              <form method="POST" action="server/add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
              </form>


            </div>
          </div>
        </div>

        <!-- Product Modal -->
        <div class="modal fade" id="productModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered position-relative">
            <!-- Fixed Close Button -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" style="z-index:1056;"
              data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-content position-relative p-4">
              <div class="modal-body">
                <div class="row">
                  <!-- Image Section -->
                  <div class="col-md-6 mb-3">
                    <div class="border p-2 text-center" style="min-height:300px;">
                      <img id="mainImage<?php echo $row['id']; ?>" src="assets/imgs/<?php echo $row['main_image']; ?>"
                        class="img-fluid" alt="Main View" style="max-height:280px; object-fit:contain;">
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_2']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_3']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                    </div>
                  </div>

                  <!-- Details Section -->
                  <div class="col-md-6">
                    <h5 class="mb-3">
                      <?php echo htmlspecialchars($row['name']); ?>
                    </h5>
                    <p><strong>Location:</strong>
                      <?php echo htmlspecialchars($row['location']); ?>
                    </p>
                    <p><strong>Seller:</strong>
                      <?php echo htmlspecialchars($row['seller_name'] . ' ' . $row['seller_surname']); ?>
                    </p>
                    <p><strong>Description:</strong>
                      <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>
                    <p><strong>Price:</strong> R
                      <?php echo number_format($row['price'], 2); ?>
                    </p>

                    <form method="POST" action="server/add_to_cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                      <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                      <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">

                      <div class="mb-3">
                        <label for="quantity<?php echo $row['id']; ?>" class="form-label">Quantity:</label>
                        <input type="number" id="quantity<?php echo $row['id']; ?>" name="quantity" class="form-control"
                          value="1" min="1">
                      </div>

                      <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                    </form>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } // end while ?>
      </div>
    </div>
  </section>

  <!-- Tech Section -->
  <section id="tech-listings" class="py-5">
    <div class="container">
      <h2 class="mb-5">Tech Gadgets</h2>

      <div class="row">
        <?php include('server/get_tech_listings.php'); ?>

        <?php while ($row = $tech_listings->fetch_assoc()) { ?>
        <!-- Product Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
          <div class="product-card" style="cursor: pointer;">
            <div class="product-image-container" data-bs-toggle="modal"
              data-bs-target="#productModal<?php echo $row['id']; ?>"
              style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
              <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="product-image"
                alt="<?php echo htmlspecialchars($row['name']); ?>"
                style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
            <div class="product-details p-3">
              <h5 class="product-title" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['name']); ?>
              </h5>
              <p class="product-price mb-1" data-bs-toggle="modal"
                data-bs-target="#productModal<?php echo $row['id']; ?>">
                R
                <?php echo number_format($row['price'], 2); ?>
              </p>
              <p class="product-location text-muted">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($row['location']); ?>
              </p>
              <form method="POST" action="server/add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Product Modal -->
        <div class="modal fade" id="productModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" style="z-index:1056;"
              data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-content position-relative p-4">
              <div class="modal-body">
                <div class="row">
                  <!-- Image Section -->
                  <div class="col-md-6 mb-3">
                    <div class="border p-2 text-center" style="min-height:300px;">
                      <img id="mainImage<?php echo $row['id']; ?>" src="assets/imgs/<?php echo $row['main_image']; ?>"
                        class="img-fluid" alt="Main View" style="max-height:280px; object-fit:contain;">
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_2']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_3']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                    </div>
                  </div>

                  <!-- Details Section -->
                  <div class="col-md-6">
                    <h5 class="mb-3">
                      <?php echo htmlspecialchars($row['name']); ?>
                    </h5>
                    <p><strong>Location:</strong>
                      <?php echo htmlspecialchars($row['location']); ?>
                    </p>
                    <p><strong>Seller:</strong>
                      <?php echo htmlspecialchars($row['seller_name'] . ' ' . $row['seller_surname']); ?>
                    </p>
                    <p><strong>Description:</strong>
                      <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>
                    <p><strong>Price:</strong> R
                      <?php echo number_format($row['price'], 2); ?>
                    </p>

                    <form method="POST" action="server/add_to_cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                      <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                      <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">

                      <div class="mb-3">
                        <label for="quantity<?php echo $row['id']; ?>" class="form-label">Quantity:</label>
                        <input type="number" id="quantity<?php echo $row['id']; ?>" name="quantity" class="form-control"
                          value="1" min="1">
                      </div>

                      <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } // end while ?>
      </div>
    </div>
  </section>

  <!-- Clothing Section -->
  <section id="clothings-listings" class="py-5">
    <div class="container">
      <h2 class="mb-5">Clothing & Footwear</h2>

      <div class="row">
        <?php include('server/get_clothing_listings.php'); ?>

        <?php while ($row = $clothing_listings->fetch_assoc()) { ?>
        <!-- Product Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
          <div class="product-card" style="cursor: pointer;">
            <div class="product-image-container" data-bs-toggle="modal"
              data-bs-target="#productModal<?php echo $row['id']; ?>"
              style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
              <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="product-image"
                alt="<?php echo htmlspecialchars($row['name']); ?>"
                style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
            <div class="product-details p-3">
              <h5 class="product-title" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['name']); ?>
              </h5>
              <p class="product-price mb-1" data-bs-toggle="modal"
                data-bs-target="#productModal<?php echo $row['id']; ?>">
                R
                <?php echo number_format($row['price'], 2); ?>
              </p>
              <p class="product-location text-muted">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($row['location']); ?>
              </p>
              <form method="POST" action="server/add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Product Modal -->
        <div class="modal fade" id="productModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" style="z-index:1056;"
              data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-content position-relative p-4">
              <div class="modal-body">
                <div class="row">
                  <!-- Image Section -->
                  <div class="col-md-6 mb-3">
                    <div class="border p-2 text-center" style="min-height:300px;">
                      <img id="mainImage<?php echo $row['id']; ?>" src="assets/imgs/<?php echo $row['main_image']; ?>"
                        class="img-fluid" alt="Main View" style="max-height:280px; object-fit:contain;">
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_2']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <div class="thumbnail-box" data-target="mainImage<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row['image_3']; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                    </div>
                  </div>

                  <!-- Details Section -->
                  <div class="col-md-6">
                    <h5 class="mb-3">
                      <?php echo htmlspecialchars($row['name']); ?>
                    </h5>
                    <p><strong>Location:</strong>
                      <?php echo htmlspecialchars($row['location']); ?>
                    </p>
                    <p><strong>Seller:</strong>
                      <?php echo htmlspecialchars($row['seller_name'] . ' ' . $row['seller_surname']); ?>
                    </p>
                    <p><strong>Description:</strong>
                      <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>
                    <p><strong>Price:</strong> R
                      <?php echo number_format($row['price'], 2); ?>
                    </p>

                    <form method="POST" action="server/add_to_cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                      <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                      <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">

                      <div class="mb-3">
                        <label for="quantity<?php echo $row['id']; ?>" class="form-label">Quantity:</label>
                        <input type="number" id="quantity<?php echo $row['id']; ?>" name="quantity" class="form-control"
                          value="1" min="1">
                      </div>

                      <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } // end while ?>
      </div>
    </div>
  </section>


  <!-- Home & Living  -->
  <section id="home-listings" class="py-5">
    <div class="container">
      <h2 class="mb-5">Home & Living</h2>

      <div class="row">
        <?php include('server/get_home_listings.php'); ?>

        <?php while ($row = $home_listings->fetch_assoc()) { ?>
        <!-- Product Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
          <div class="product-card" style="cursor: pointer;">
            <div class="product-image-container" data-bs-toggle="modal"
              data-bs-target="#homeModal<?php echo $row['id']; ?>"
              style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
              <img src="assets/imgs/<?php echo $row['main_image']; ?>" class="product-image"
                alt="<?php echo htmlspecialchars($row['name']); ?>"
                style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
            <div class="product-details p-3">
              <h5 class="product-title" data-bs-toggle="modal" data-bs-target="#homeModal<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['name']); ?>
              </h5>
              <p class="product-price mb-1" data-bs-toggle="modal" data-bs-target="#homeModal<?php echo $row['id']; ?>">
                R
                <?php echo number_format($row['price'], 2); ?>
              </p>
              <p class="product-location text-muted">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($row['location']); ?>
              </p>
              <form method="POST" action="server/add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Product Modal -->
        <div class="modal fade" id="homeModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" style="z-index:1056;"
              data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-content position-relative p-4">
              <div class="modal-body">
                <div class="row">
                  <!-- Image Section -->
                  <div class="col-md-6 mb-3">
                    <div class="border p-2 text-center" style="min-height:300px;">
                      <img id="mainImageHome<?php echo $row['id']; ?>"
                        src="assets/imgs/<?php echo $row['main_image']; ?>" class="img-fluid" alt="Main View"
                        style="max-height:280px; object-fit:contain;">
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                      <?php foreach (['main_image', 'image_2', 'image_3'] as $imgField) { ?>
                      <div class="thumbnail-box" data-target="mainImageHome<?php echo $row['id']; ?>"
                        style="width:75px; height:75px; border:1px solid #ccc; padding:4px; cursor:pointer;">
                        <img src="assets/imgs/<?php echo $row[$imgField]; ?>" class="w-100 h-100"
                          style="object-fit:contain;">
                      </div>
                      <?php } ?>
                    </div>
                  </div>

                  <!-- Details Section -->
                  <div class="col-md-6">
                    <h5 class="mb-3">
                      <?php echo htmlspecialchars($row['name']); ?>
                    </h5>
                    <p><strong>Location:</strong>
                      <?php echo htmlspecialchars($row['location']); ?>
                    </p>
                    <p><strong>Seller:</strong>
                      <?php echo htmlspecialchars($row['seller_name'] . ' ' . $row['seller_surname']); ?>
                    </p>
                    <p><strong>Description:</strong>
                      <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>
                    <p><strong>Price:</strong> R
                      <?php echo number_format($row['price'], 2); ?>
                    </p>

                    <form method="POST" action="server/add_to_cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                      <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                      <input type="hidden" name="product_image" value="<?php echo $row['main_image']; ?>">

                      <div class="mb-3">
                        <label for="quantityHome<?php echo $row['id']; ?>" class="form-label">Quantity:</label>
                        <input type="number" id="quantityHome<?php echo $row['id']; ?>" name="quantity"
                          class="form-control" value="1" min="1">
                      </div>

                      <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>








  <script>
    document.querySelectorAll('.thumbnail-box').forEach(box => {
      box.addEventListener('click', function () {
        const targetId = this.dataset.target;
        const mainImage = document.getElementById(targetId);
        const newSrc = this.querySelector('img').src;

        // Update main image
        mainImage.src = newSrc;

        // Remove highlight from all thumbnails with same target
        document.querySelectorAll(`.thumbnail-box[data-target="${targetId}"]`).forEach(b =>
          b.classList.remove('thumbnail-active')
        );

        // Add highlight to clicked one
        this.classList.add('thumbnail-active');


      });
    });
  </script>

  <?php include'layouts/footer.php';?>



