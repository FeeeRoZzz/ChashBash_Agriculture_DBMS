<?php
// Include database connection
include 'db_connect.php';

// Initialize message variable
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $product_name = $_POST['product-name'];
    $type = $_POST['type'];
    $variety = $_POST['variety'];
    $seasonality = $_POST['seasonality'];
    $historical_price = $_POST['historical-price'];
    $present_price = $_POST['present-price'];

    // Insert data into the database (without the id field)
    $sql = "INSERT INTO product (name, type, variety, seasonality, hprice, pprice) 
            VALUES ('$product_name', '$type', '$variety', '$seasonality', '$historical_price', '$present_price')";

    if (mysqli_query($conn, $sql)) {
        $message = "Product added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Chashbash</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <h2>চাষবাস.কম</h2>
        </div>
        <div class="menu">
            <ul>
            <li><a href="AMR_Dashboard">HOME</a></li>
                <li><a href="product.php">PRODUCT</a></li>
                <li><a href="farmer-price.php">FARMER PRICE</a></li>
                <li><a href="price-control.php">PRICE CONTROL</a></li>
                <li><a href="LogOut.php">LOG OUT/a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Add New Product</h1>

        <!-- Display message -->
        <?php if ($message): ?>
            <p style="color: green;"><?= $message; ?></p>
        <?php endif; ?>

        <!-- Form for adding product -->
        <form action="" method="POST">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name" placeholder="Enter Product Name" required>

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" placeholder="Enter Product Type" required>

            <label for="variety">Variety:</label>
            <input type="text" id="variety" name="variety" placeholder="Enter Product Variety" required>

            <label for="seasonality">Seasonality:</label>
            <input type="text" id="seasonality" name="seasonality" placeholder="Enter Product Seasonality" required>

            <label for="historical-price">Historical Price (Per KG):</label>
            <input type="number" id="historical-price" name="historical-price" placeholder="Enter Historical Price" required>

            <label for="present-price">Present Price (Per KG):</label>
            <input type="number" id="present-price" name="present-price" placeholder="Enter Present Price" required>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Chashbash. All Rights Reserved.</p
