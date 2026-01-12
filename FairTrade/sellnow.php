<?php session_start(); ?>

<?php include 'layouts/header.php'; ?>

<head>
<title>Sell Now</title>
</head>




<!--Sell Now Page-->
<section>
  <div class="container my-5 pt-5">
    <h2 class="text-center mb-4" style="font-weight: bold;">Sell Now</h2>
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
      <div class="alert alert-success text-center" id="listingSuccessMsg">
        ✅ Product listed successfully!
      </div>

      <script>
        // Auto-hide after 3 seconds
        setTimeout(() => {
          document.getElementById('listingSuccessMsg')?.remove();
        }, 5000);
      </script>
    <?php endif; ?>

    <form action="server/list_product.php" method="POST" enctype="multipart/form-data">
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control" name="first_name" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" class="form-control" name="location" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Product Category</label>
        <select class="form-select" name="category" required>
          <option disabled selected>Select a category</option>
          <option value="Tech">Tech</option>
          <option value="Clothing">Clothing</option>
          <option value="Home">Home</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" name="product_name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Price (R)</label>
        <input type="number" class="form-control" name="price" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Product Description</label>
        <textarea class="form-control" name="description" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Main Image</label>
        <input type="file" class="form-control" name="main_image" accept="image/*" required>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Additional Image 1</label>
          <input type="file" class="form-control" name="image_2" accept="image/*">
        </div>
        <div class="col-md-6">
          <label class="form-label">Additional Image 2</label>
          <input type="file" class="form-control" name="image_3" accept="image/*">
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-secondary px-5">List Product</button>
      </div>
    </form>
  </div>
</section>







<?php include'layouts/footer.php';?>