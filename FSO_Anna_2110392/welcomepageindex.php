
<?php
// Start a session to manage user login or other data.
session_start();

// Example session variables (update based on your logic).
$userLoggedIn = isset($_SESSION['user']); // Check if the user is logged in.
$userName = $userLoggedIn ? $_SESSION['user']['name'] : 'Guest'; // Retrieve user name if logged in.
$welcomeMessage = $userLoggedIn ? "Welcome back, $userName!" : "Welcome to চাষবাস";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Chashbash</title>
    <link rel="stylesheet" href="welcomepagestyle.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header class="navbar">
        <h1>Chashbash</h1>
        <ul>
            <li><a href="foodsafetyofficerdashboardindex.php">Dashboard</a></li>
            <li><a href="addproductiondataindex.php">Add Production Data</a></li>
            <li><a href="productionrecordindex.php">Production Record</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>
    </header>
    <!-- Welcome Section -->
    <div class="welcome-container">
        <h1><?php echo $welcomeMessage; ?></h1>
        <p>Transforming Agriculture with Technology. Join us in driving innovation, enhancing sustainability, and ensuring food safety for the future.</p>
    </div>
</body>
</html>
