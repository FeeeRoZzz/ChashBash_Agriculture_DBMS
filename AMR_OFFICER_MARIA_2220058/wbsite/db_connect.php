<?php
// Database credentials
$servername = "localhost"; // Replace with your server name or IP
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "chasbash"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If connected successfully
//echo "Database connected successfully.";
?>
