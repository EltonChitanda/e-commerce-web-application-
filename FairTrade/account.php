<?php
session_start();
require 'server/config.php';

if (!isset($_SESSION['user'])) {
    echo "<p>User information not available. Please <a href='login.php'>log in</a>.</p>";
    exit();
}

$user = $_SESSION['user'];
$user_id = $user['id'];

// Fetch orders
$orders = [];
$order_stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
if ($order_result->num_rows > 0) {
    $orders = $order_result->fetch_all(MYSQLI_ASSOC);
}

// Fetch listings
$listings = [];
$listing_stmt = $conn->prepare("SELECT * FROM products WHERE user_id = ?");
$listing_stmt->bind_param("i", $user_id);
$listing_stmt->execute();
$listing_result = $listing_stmt->get_result();
if ($listing_result->num_rows > 0) {
    $listings = $listing_result->fetch_all(MYSQLI_ASSOC);
}
?>


<?php include'layouts/header.php';?>

<head>
<title>Account</title>
</head>





    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12 ">
                <!-- Success message container -->
                <?php if (isset($_SESSION['login_success'])): ?>
                    <div id="login-message" style="font-weight:bold; margin-bottom:10px; color:green;">
                        Logged in successfully!
                    </div>
                    <?php unset($_SESSION['login_success']); ?>
                <?php endif; ?>
                <h2>Account Info</h2>
                <hr class="mx-auto">
                <div class="account-info">
                    <?php if ($user && is_array($user)): ?>
                        <p>Name: <span><?= htmlspecialchars($user['name']) ?></span></p>
                        <p>Surname: <span><?= htmlspecialchars($user['surname']) ?></span></p>
                        <p>Email: <span><?= htmlspecialchars($user['email']) ?></span></p>
                    <?php else: ?>
                        <p>User information not available.</p>
                    <?php endif; ?>


                    <p><a href="#orders" id="orders-btn" style="color: darkblue;" ;>Your Orders and Listings</a></p>
                    <p><a href="logout.php" id="logout-btn" style="color: darkblue;">Logout</a></p>


                </div>

            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- Change Password Form -->
                <form id="account-form">
                    <!-- Success/Error Message -->
                    <div id="password-message" style="display: none; font-weight: bold; margin-bottom: 10px;"></div>

                    <h3>Change Password</h3>
                    <hr class="mx-auto">

                    <!-- New Password -->
                    <div class="form-group">
                        <label>New Password</label>
                        <div class="password-wrapper" style="position: relative;">
                            <input type="password" class="form-control" id="account-password" name="password"
                                placeholder="New Password" required />
                            <span class="toggle-password" toggle="#account-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="password-wrapper" style="position: relative;">
                            <input type="password" class="form-control" id="account-password" name="password"
                                placeholder="New Password" required />
                            <span class="toggle-password" toggle="#account-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <input type="submit" value="Change Password" class="btn btn-primary" id="change-pass-btn" />
                    </div>
                </form>
            </div>

        </div>
    </section>

    <!--Orders and Listings-->
    <section class="listings container my-5 py-3">
        <div class="container mt-2" id="orders">
            <h2 class="mb-5 text-center">Your Orders</h2>
            <hr class="mx-auto" style="width: 100px;">
        </div>

        <table class="mt-5 pt-5" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #333;">
                    <th style="text-align: left; padding: 8px;">Order ID</th>
                    <th style="text-align: center; padding: 8px;">Total Amount</th>
                    <th style="text-align: center; padding: 8px;">Order Date</th>
                    <th style="text-align: center; padding: 8px;">Status</th>
                    <th style="text-align: center; padding: 8px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr style="border-bottom: 1px solid #ccc;">
                            <td style="padding: 8px;">#<?= htmlspecialchars($order['id']) ?></td>
                            <td style="text-align: center; padding: 8px;">R <?= htmlspecialchars($order['total_amount']) ?></td>
                            <td style="text-align: center; padding: 8px;"><?= htmlspecialchars($order['order_date']) ?></td>
                            <td style="text-align: center; padding: 8px; color: 
                        <?=
                            $order['status'] === 'Paid' ? 'green' :
                            ($order['status'] === 'Cancelled' ? 'gray' : 'orange')
                            ?>;">
                                <?= htmlspecialchars($order['status']) ?>
                            </td>
                            <td style="text-align: center; vertical-align: middle; padding: 8px;">
                                <?php if ($order['status'] === 'Pending'): ?>
                                    <form action="server/cancel_order.php" method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <button type="submit" style="background: none; border: none; cursor: pointer;"
                                            title="Cancel Order">
                                            <i class="fas fa-trash" style="color: red;"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span style="color: gray;">Not Available</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 8px;">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


    </section>

    <!-- Listings -->
    <section class="listings container my-5 py-3">
        <div class="container mt-2">
            <h2 class="mb-5 text-center">Your Listings</h2>
            <hr class="mx-auto" style="width: 100px;">
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #333;">
                    <th style="width: 50%; text-align: left; padding: 8px;">Product</th>
                    <th style="width: 15%; text-align: center; padding: 8px;">Price</th>
                    <th style="width: 15%; text-align: center; padding: 8px;">Status</th>
                    <th style="width: 20%; text-align: center; padding: 8px;">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listings)): ?>
                    <?php foreach ($listings as $listing): ?>
                        <tr style="border-bottom: 1px solid #ccc;">
                            <td style="padding: 8px;">
                                <div style="display: flex; align-items: center;">
                                    <img src="assets/imgs/<?= htmlspecialchars($listing['main_image']) ?>" width="70" />

                                    <p style="margin: 0;"><?= htmlspecialchars($listing['name']) ?></p>
                                </div>
                            </td>
                            <td style="text-align: center; vertical-align: middle; padding: 8px;">
                                R<?= htmlspecialchars($listing['price']) ?></td>
                            <td style="text-align: center; vertical-align: middle; padding: 8px; color:
<?= $listing['status'] == 'paid' ? 'red' : ($listing['status'] == 'sold' ? 'orange' : 'green') ?>">
<?= ucfirst($listing['status']) ?>
</td>

                            <td style="text-align: center; vertical-align: middle; padding: 8px;">
                                <form action="server/remove_listing.php" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this listing?');">
                                    <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
                                    <button type="submit" style="background: none; border: none; cursor: pointer;"
                                        title="Remove Listing">
                                        <i class="fas fa-trash" style="color: red;"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 8px;">No listings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>





 

    <script>
        document.querySelectorAll(".toggle-password").forEach(function (element) {
            element.addEventListener("click", function () {
                const input = document.querySelector(this.getAttribute("toggle"));
                if (input.type === "password") {
                    input.type = "text";
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    input.type = "password";
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>


    <script>
        const loginMessage = document.getElementById("login-message");
        if (loginMessage) {
            setTimeout(() => {
                loginMessage.style.display = "none";
            }, 3000);
        }
    </script>





<?php include'layouts/footer.php';?>