
<?php session_start(); ?>
<?php include'layouts/header.php';?>

<head>
<title>Forgot Password</title>
</head>

<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2>Reset Your Password</h2>
    <hr class="mx-auto">
  </div>

  <div class="mx-auto" style="max-width: 500px;">
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success text-center">
        Password updated successfully! You can now <a href="login.php">login</a>.
      </div>
    <?php elseif (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form method="POST" action="server/process_password_reset.php">
      <div class="form-group mb-4">
        <label>Email Address</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group mb-4">
        <label>New Password</label>
        <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
      </div>

      <div class="form-group mb-4">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm new password" required>
      </div>

      <div class="text-center">
        <input type="submit" class="btn btn-secondary px-4" value="Reset Password">
      </div>
    </form>
  </div>
</section>



<?php include'layouts/footer.php';?>
