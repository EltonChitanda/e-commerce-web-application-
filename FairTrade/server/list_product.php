<?php
session_start();
include'config.php'; // Adjust the path if needed

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to list a product.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $user_id = $_SESSION['user_id'];
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $location = htmlspecialchars($_POST['location']);
    $category = htmlspecialchars($_POST['category']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $price = floatval($_POST['price']);
    $description = htmlspecialchars($_POST['description']);

    // Image upload directory
    $upload_dir = "../assets/imgs/";

    // Helper to handle image upload
    function upload_image($input_name, $upload_dir) {
        if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES[$input_name]['tmp_name'];
            $file_name = time() . '_' . basename($_FILES[$input_name]['name']);
            $target_path = $upload_dir . $file_name;
            if (move_uploaded_file($file_tmp, $target_path)) {
                return $file_name;
            }
        }
        return null;
    }

    // Upload images
    $main_image = upload_image('main_image', $upload_dir);
    $image_2 = upload_image('image_2', $upload_dir);
    $image_3 = upload_image('image_3', $upload_dir);

    if (!$main_image) {
        die("Main image upload failed. Please try again.");
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO products 
        (user_id, name, description, price, category, location, main_image, image_2, image_3) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issdsssss", $user_id, $product_name, $description, $price, $category, $location, $main_image, $image_2, $image_3);

    if ($stmt->execute()) {
        header("Location: ../sellnow.php?status=success");

        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
