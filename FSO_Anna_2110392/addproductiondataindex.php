<?php
include('db.php');

// Initialize messages
$successMessage = '';
$errorMessage = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $yields = $_POST['yields'] ?? '';
    $acreage = $_POST['acreage'] ?? '';
    $cost = $_POST['cost'] ?? '';

    if (empty($productName) || empty($yields) || empty($acreage) || empty($cost)) {
        $errorMessage = 'All fields are required!';
    } else {
        $stmt = $conn->prepare("INSERT INTO production_records_t (product_name, yields, acreage, cost) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdds", $productName, $yields, $acreage, $cost);

        if ($stmt->execute()) {
            // Redirect to the production record index page
            header('Location: productionrecordindex.php');
            exit(); // Ensure no further code is executed
        } else {
            $errorMessage = 'Error submitting data: ' . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Production Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Add Production Data</h1>

    <?php if ($successMessage): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="yields">Yields:</label>
        <input type="number" id="yields" name="yields" required>

        <label for="acreage">Acreage:</label>
        <input type="number" id="acreage" name="acreage" required>

        <label for="cost">Cost:</label>
        <input type="number" id="cost" name="cost" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>





