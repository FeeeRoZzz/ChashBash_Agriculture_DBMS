<?php
// Include database connection
include 'db_connect.php';

// Handle delete functionality
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM product WHERE id = $id";
    if ($conn->query($deleteQuery)) {
        echo "<script>alert('Product deleted successfully!'); window.location='product.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product: " . $conn->error . "');</script>";
    }
}

// Handle search functionality
$searchQuery = "";
if (isset($_POST['search'])) {
    $searchInput = $conn->real_escape_string($_POST['search-input']);
    $searchQuery = "WHERE name LIKE '%$searchInput%' OR type LIKE '%$searchInput%' OR variety LIKE '%$searchInput%'";
}

// Fetch product data from the database
$query = "SELECT * FROM product $searchQuery";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Chashbash</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .navbar {
            background-color: #3498db;
            padding: 15px 30px;
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
            margin: 0 15px;
        }

        .navbar .menu ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 16px;
        }

        .navbar .menu ul li a:hover {
            background-color: #1d6f99;
            border-radius: 5px;
        }

        .main-content {
            margin: 20px auto;
            width: 90%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            width: 100%; /* Make the container span the full width */
            margin-bottom: 10px; /* Add space below */
            position: relative;
        }

        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px; /* Reduced padding for a smaller button */
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
            width: auto;
        }

        .add-button:hover {
            background-color: #45a049;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
            width: 300px;
        }

        .search-container button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #1d6f99;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }

        table th {
            background-color: #3498db;
            color: white;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #3498db;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
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
            <li><a href="AMR_Dashboard.php">HOME</a></li>
                <li><a href="product.php">PRODUCT</a></li>
                <li><a href="farmer-price.php">FARMER PRICE</a></li>
                <li><a href="price-control.php">PRICE CONTROL</a></li>
                <li><a href="LogOut.php">LOG OUT</li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Our Products</h1>

        <!-- Add and Search Buttons -->
        <div class="button-container">
            <a href="add-product.php" class="add-button">Add New Product</a>
            <div class="search-container">
                <form method="POST" action="product.php">
                    <input type="text" name="search-input" placeholder="Search by name, type, or variety..." value="<?= isset($searchInput) ? htmlspecialchars($searchInput) : '' ?>">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Variety</th>
                        <th>Seasonality</th>
                        <th>Historical Price (TAKA)</th>
                        <th>Present Price (TAKA)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['type']) ?></td>
                            <td><?= htmlspecialchars($row['variety']) ?></td>
                            <td><?= htmlspecialchars($row['seasonality']) ?></td>
                            <td><?= htmlspecialchars($row['hprice']) ?></td>
                            <td><?= htmlspecialchars($row['pprice']) ?></td>
                            <td>
                                <a href="product.php?delete=<?= $row['id'] ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found in the database.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Chashbash. All Rights Reserved.</p>
    </footer>
</body>
</html>

//<?php
// Close the database connection
//$conn->close();
//?>
