<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tutorial';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to auto-generate Product ID
function generateProductID($conn) {
    $sql = "SELECT MAX(id) AS max_id FROM productiondata";
    $result = $conn->query($sql);
    $max_id = $result->fetch_assoc()['max_id'] ?? 0;
    return "P" . str_pad($max_id + 1, 3, "0", STR_PAD_LEFT);
}

// Initialize message
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $acreage = $_POST['acreage'];
    $yield = $_POST['yield'];
    $cost_per_hectare = $_POST['cost_per_hectare'];
    $edit_id = $_POST['edit_id'] ?? '';

    // Check if the product already exists
    $check_sql = "SELECT * FROM productiondata WHERE product_name = '$product_name'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $message = "Error: Product with the same name already exists!";
    } else {
        // If it's an edit request
        if ($edit_id) {
            $sql = "UPDATE productiondata SET 
                    product_name = '$product_name', 
                    acreage = '$acreage', 
                    yield = '$yield', 
                    cost_per_hectare = '$cost_per_hectare' 
                    WHERE id = $edit_id";
        } else {
            // Otherwise, insert a new record
            $product_id = generateProductID($conn);
            $sql = "INSERT INTO productiondata (product_id, product_name, acreage, yield, cost_per_hectare) 
                    VALUES ('$product_id', '$product_name', '$acreage', '$yield', '$cost_per_hectare')";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM productiondata WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle edit
$edit_row = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM productiondata WHERE id = $edit_id");
    $edit_row = $result->fetch_assoc();
}

// Handle search
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM productiondata WHERE product_name LIKE '%$search%' ORDER BY product_name";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Production Data  </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/FarmerDashboard.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


      <!-- Sidebar Start -->
      <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="admin_index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>চাষবাস.কম</h3>
                    
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../images/FarmerDashboard/a_user.jpeg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">FEROZ</h6>
                        <span> ADMIN </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin_index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> HOME </a>
                    <div class="nav-item dropdown">
                        <div class="nav-item dropdown">
                            <div class="nav-item dropdown">
                                <a href="add_new.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cube"></i> PRODUCTS </a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="ProductInfo.php" class="dropdown-item">PRODUCT INFORMATION</a>
                                    <a href="ProductionData.php" class="dropdown-item">PRODUCTION DATA</a> 
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog"></i> WAREHOUSE </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="AdminInventory.php" class="dropdown-item">INVENTORY</a>
                            <a href="AdminLogistic.php" class="dropdown-item">LOGISTIC</a>
                            <!-- <a href="AdminMarketPrice.php" class="dropdown-item">MARKET PRICE</a> -->
                        
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>
                    <a href="ProductAnalysis.php" class="nav-item nav-link"><i class="fa fa-globe"></i> ANALYSIS </a>
                    <a href="AdminConsumer.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>CONSUMER </a>

                    <a href="weather.php" class="nav-item nav-link"><i class="fa fa-thermometer-quarter"></i> WEATHER APP </a>
                    
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/FarmerDashboard/f_user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Farmer send you a message</h6>
                                        <small>10 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/FarmerDashboard/m_user.jpg"" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Manager send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/FarmerDashboard/f_user.jpg"" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">farmer send you a message</h6>
                                        <small>20 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">farmer Info updated</h6>
                                <small>12 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0"> New Products Added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Manager Profile Updated </h6>
                                <small>18 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../images/FarmerDashboard/a_user.jpeg"" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">FEROZ</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            
                            <a href="LogOut.php" class="dropdown-item"> LOG OUT </a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        } */
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
        }
        input, button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Production Data</h1>
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST">
        <input type="hidden" name="edit_id" value="<?php echo $edit_row['id'] ?? ''; ?>">
        <input type="text" name="product_name" placeholder="Product Name" value="<?php echo $edit_row['product_name'] ?? ''; ?>" required>
        <input type="number" name="acreage" step="0.01" placeholder="Acreage (hectares)" value="<?php echo $edit_row['acreage'] ?? ''; ?>" required>
        <input type="number" name="yield" step="0.01" placeholder="Yield (tons)" value="<?php echo $edit_row['yield'] ?? ''; ?>" required>
        <input type="number" name="cost_per_hectare" step="0.01" placeholder="Cost per Hectare" value="<?php echo $edit_row['cost_per_hectare'] ?? ''; ?>" required>
        <button type="submit"><?php echo isset($edit_row) ? 'Update' : 'Add'; ?> Record</button>
    </form>

    <!-- Search -->
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Product Name" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>

    <!-- Table -->
    <table>
        <tr>
            <th>Farmer ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Acreage (Hectares)</th>
            <th>Yield (Tons)</th>
            <th>Cost / Hectares </th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['acreage']; ?></td>
                    <td><?php echo $row['yield']; ?></td>
                    <td><?php echo $row['cost_per_hectare']; ?></td>
                    <td>
                        <a href="?edit_id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No data found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>



















<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
           


           


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">ChashBash.Com</a> , Copyright © 2024 - All Right Reserved 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            
                            Designed By <a href="">FEROZ MAHMUD</a>
                        </br>
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>

<?php $conn->close(); ?>




