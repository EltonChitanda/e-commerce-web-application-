<?php
$host = "localhost";
$dbname = "php_project";   
$username = "root";
$password = "";            // XAMPP default is empty

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
