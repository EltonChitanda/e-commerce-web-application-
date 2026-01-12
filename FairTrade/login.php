<?php include 'layouts/header.php'; ?>

<head>
<title>Login</title>
</head>

<!--Login-->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-wieght-bold">Login</h2>
    <hr class="mx-auto">
  </div>
  <div class="mx-auto-container">
    <form id="login-form" method="POST" action="server/login_process.php">

      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password"
          required />
      </div>

      <div class="form-group">
        <input type="submit" class="btn" id="login-btn" value="Login" />
      </div>

      <div class="form-group">
        <a href="forgot_password.php" class="btn">Forgot your password?</a>
      </div>

      <div class="form-group">
        <a id="register-url" class="btn" href="register.php">Don't have an account? Register</a>
      </div>

      

    </form>
  </div>
</section>



<?php include 'layouts/footer.php'; ?>