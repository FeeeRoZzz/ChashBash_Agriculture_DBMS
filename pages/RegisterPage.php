<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "user"; // Database name

session_start();

// Connect to the database
$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve the form data and sanitize it
    $username = mysqli_real_escape_string($data, $_POST["username"]);
    $password = mysqli_real_escape_string($data, $_POST["password"]);
    $usertype = mysqli_real_escape_string($data, $_POST["usertype"]);

    // SQL query to insert data into the login table (password as plain text)
    $sql = "INSERT INTO login (username, password, usertype) VALUES ('$username', '$password', '$usertype')";

    // Execute the query and check for success
    if (mysqli_query($data, $sql)) {
        echo "Registration successful!";  // You can redirect to the login page or another page
        // Redirect to login page after successful registration
        header("Location: LoginPage.php");  // Change this to your actual login page
    } else {
        // Display an error message if insertion fails
        echo "Error: " . $sql . "<br>" . mysqli_error($data);
    }
}

// Close the database connection
mysqli_close($data);
?>







<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> চাষবাস : রেজিস্টার </title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/Loginstyle.css">
</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0"><i class="bi-geo-alt me-2"></i> বসুন্ধরা আবাসিক এলাকা , ঢাকা</p>
                    <p class="d-flex mb-0"><i class="bi-envelope me-2"></i>
                        <a href="mailto:contact@chashbash.com.bd">contact@chashbash.com.bd</a>
                    </p>
                </div>
                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item"><a href="#" class="social-icon-link bi-facebook"></a></li>
                        <li class="social-icon-item"><a href="#" class="social-icon-link bi-instagram"></a></li>
                        <li class="social-icon-item"><a href="#" class="social-icon-link bi-youtube"></a></li>
                        <li class="social-icon-item"><a href="#" class="social-icon-link bi-github"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="../images/logo.png" class="logo img-fluid" alt="চাষবাস.কম">
                <span>
                    চাষবাস.কম
                    <small> FARMERS ARE NOW DIGITAL </small>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link custom-btn custom-border-btn btn" href="LoginPage.php">LOG IN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Registration Form -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12">
                    <form action="#" method="post" class="p-4 bg-white shadow rounded">
                        <h3 class="text-center mb-4">Register</h3>
                        <div class="mb-3">
                            <label for="username" class="form-label"><b>Username</b></label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><b>Password</b></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="mb-3">
                        <div class="mb-3">
                        <label for="designation" class="form-label"><b>Designation</b></label>
                        <select id="designation" name="usertype" class="form-select" required>
                            <option value="" disabled selected>Select Designation</option>
                            <option value="admin">Admin</option>
                            <option value="farmer">Farmer</option>
                            <option value="manager">Manager</option>
                            <option value="fso">Food Safety Officer</option>
                            <option value="amr">AMR Officer</option>
                        </select>
                    </div>

                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100 me-2">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer mt-5">
        <div class="container">
            <p class="text-center">Copyright © 2024 <a href="#">চাষবাস.কম</a>. Design By: <a href="#">FEROZ MAHMUD</a></p>
        </div>
    </footer>

    <!-- JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>


