<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <h1>Edit Product</h1>
        <form class="edit-form">
            <label for="product-id">Product ID:</label>
            <input type="text" id="product-id" name="product-id" readonly value="1120">

            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name" value="Rice">

            <label for="updated-price">Updated Price (TAKA):</label>
            <input type="number" id="updated-price" name="updated-price">

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
