<?php include'layouts/header.php';?>

<head>
<title>Register</title>
</head>

  <!--Register-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-wieght-bold">Register</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto-container">
      <form id="register-form" method="POST" action="server/register_process.php">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label>Surame</label>
          <input type="text" class="form-control" id="register-surname" name="surname" placeholder="Surname" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" class="form-control" id="register-password" name="password" placeholder="Password"
            required />
        </div>
        <div class="form-group">
          <label> Confirm Password</label>
          <input type="text" class="form-control" id="register-confirm-password" name="confirmPassword"
            placeholder="Confirm Password" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="Register" />
        </div>
        <div class="form-group">
          <a id="login-url" class="btn" href="login.php">Do you already have an account ? Login</a>
        </div>

      </form>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <h5 class="mb-3">FairTrade</h5>
          <p class="small text-white-50">A student project for C2C e-commerce in South Africa</p>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
          <h6 class="mb-3">Quick Links</h6>
          <ul class="list-unstyled small">
            <li class="mb-2"><a href="#" class="text-white-50">Home</a></li>
            <li class="mb-2"><a href="#" class="text-white-50">List an Item</a></li>
            <li><a href="#" class="text-white-50">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="mb-3">Project Info</h6>
          <ul class="list-unstyled small">
            <li class="mb-2 text-white-50">Student: Elton Chitanda</li>
            <li class="text-white-50">Course: ITECA</li>
          </ul>
        </div>
      </div>
      <hr class="my-4 bg-secondary">
      <div class="text-center small text-white-50">
        &copy; 2025 FairTrade
      </div>
    </div>
  </footer>


<?php include'layouts/footer.php';?>