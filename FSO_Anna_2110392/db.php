<?php
// Database configuration
$host = "localhost"; // Database host, typically "localhost"
$username = "root";  // Database username
$password = "";      // Database password (use the correct password for your setup)
$database = "tutorial"; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database!";
}

// Close the connection (optional, when you're done with it)
// $conn->close();
?>
