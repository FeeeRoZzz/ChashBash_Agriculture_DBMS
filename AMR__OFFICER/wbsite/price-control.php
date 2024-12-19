<?php
// Include database connection
include 'db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $product_id = $_POST['product-id'];
    $new_price = $_POST['new-price'];

    // Validate the inputs
    if (!empty($product_id) && !empty($new_price)) {
        // Update the present price in the database
        $sql = "UPDATE product SET pprice = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $new_price, $product_id);

        if ($stmt->execute()) {
            $message = "Price updated successfully!";
            // Redirect to the product page after successful update
            header("Location: product.php");
            exit;
        } else {
            $message = "Error updating price: " . $conn->error;
        }
    } else {
        $message = "Please provide both Product ID and New Price.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Control</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #3498db;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar .menu ul li {
            margin: 0 10px;
        }

        .navbar .menu ul li a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
        }

        .navbar .menu ul li a:hover {
            background-color: #3498db;
            border-radius: 5px;
        }

        .main {
            margin: 20px;
        }

        h1 {
            color: #3498db;
        }

        .price-control-form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 20px auto;
        }

        .price-control-form label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .price-control-form input {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .price-control-form button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .price-control-form button:hover {
            background-color: #3498db;
        }

        .message {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <h2>চাষবাস.কম</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="product.php">PRODUCT</a></li>
                <li><a href="farmer-price.php">FARMER PRICE</a></li>
                <li><a href="price-control.php">PRICE CONTROL</a></li>
                <li><a href="#">CONTACT</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h1>Price Control</h1>

        <!-- Display message if any -->
        <?php if (isset($message)): ?>
            <p class="message"><?= $message; ?></p>
        <?php endif; ?>

        <!-- Form to update the price -->
        <form class="price-control-form" method="POST" action="price-control.php">
            <label for="product-id">Product ID:</label>
            <input type="text" id="product-id" name="product-id" placeholder="Enter Product ID" required>

            <label for="new-price">New Price (TAKA):</label>
            <input type="number" id="new-price" name="new-price" placeholder="Enter New Price" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
