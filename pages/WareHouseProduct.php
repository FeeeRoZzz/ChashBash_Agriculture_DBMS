<?php
// Database Configuration
$host = 'localhost';
$dbname = 'tutorial';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle Add, Edit, and Delete Operations
$error_message = ''; // Initialize an empty error message variable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add Inventory Item
        $name = $_POST['name'];
        $warehouseID = $_POST['warehouseID'];
        $storage_quantity_kg = $_POST['storage_quantity_kg'];

        // Check if item already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM inventory WHERE name = ?");
        $stmt->execute([$name]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // If the item already exists, show an error message
            $error_message = "Item with this name already exists.";
        } else {
            // If no duplicate, proceed with insertion
            $stmt = $pdo->prepare("INSERT INTO inventory (name, warehouseID, storage_quantity_kg) VALUES (?, ?, ?)");
            $stmt->execute([$name, $warehouseID, $storage_quantity_kg]);
        }
    } elseif (isset($_POST['edit'])) {
        // Edit Inventory Item
        $id = $_POST['id'];
        $name = $_POST['name'];
        $warehouseID = $_POST['warehouseID'];
        $storage_quantity_kg = $_POST['storage_quantity_kg'];
        $stmt = $pdo->prepare("UPDATE inventory SET name = ?, warehouseID = ?, storage_quantity_kg = ? WHERE PrimaryID = ?");
        $stmt->execute([$name, $warehouseID, $storage_quantity_kg, $id]);
    }
} elseif (isset($_GET['delete'])) {
    // Delete Inventory Item
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE PrimaryID = ?");
    $stmt->execute([$id]);
}

// Fetch Inventory Data
$search = $_GET['search'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM inventory WHERE name LIKE ?");
$stmt->execute(['%' . $search . '%']);
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> WAREHOUSE MANAGER </title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


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
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>চাষবাস.কম</h3>
                    
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../images/FarmerDashboard/m_user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">KASHEM</h6>
                        <span>W_MANAGER </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="WareHouseManagerDashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> HOME </a>
                    <div class="nav-item dropdown">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> INVENTORY </a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="WareHouseProduct.php" class="dropdown-item"> PRODUCT LIST </a>
                            </div>
                        
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>
                    <a href="WareHouseLogistics.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOGISTICS</a>
                    <a href="WareHouseNoti.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>NOTIFICATION</a>
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
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
                                        <h6 class="fw-normal mb-0">Jabbar send you a message</h6>
                                        <small>10 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/FarmerDashboard/a_user.jpeg"" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Admin send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/FarmerDashboard/f_user.jpg"" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jabbar send you a message</h6>
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
                                <h6 class="fw-normal mb-0">New Product Launch</h6>
                                <small>12 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New Update From farmer</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Product changed</h6>
                                <small>18 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../images/FarmerDashboard/m_user.jpg"" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">KASHEM </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="LogOut.php" class="dropdown-item"> LOG OUT </a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


           <!-- Sale & Revenue Start -->
             
           <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-carrot fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2"> কৃষক </p>
                                <h6 class="mb-0"> ৫০,০০০+ জন </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">ফসল</p>
                                <h6 class="mb-0"> ৩০ প্রজাতির </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-carrot fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">ঋতুকালীন </p>
                                <h6 class="mb-0"> পন্য সরবরাহ </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">পণ্যর চাহিদা</p>
                                <h6 class="mb-0"> যাচাইকরণ </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <style>
    
    .container {
        width: 80%;
        max-width: 1000px;
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        box-sizing: border-box;
        text-align: center;
    }
    h1 {
        color: #28a745;
        font-size: 36px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .search-box {
        width: 70%;
        padding: 12px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin: 10px 0;
        transition: border-color 0.3s ease;
    }
    .search-box:focus {
        border-color: #007bff;
    }
    .search-btn {
        padding: 12px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .search-btn:hover {
        background-color: #218838;
    }
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 12px;
        text-align: center;
        font-size: 16px;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    td {
        background-color: #f9f9f9;
    }
    .action-btn {
        padding: 8px 15px;
        margin: 2px;
        text-decoration: none;
        color: white;
        background-color: #007bff;
        border-radius: 3px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }
    .action-btn:hover {
        background-color: #0056b3;
    }
    .action-btn.delete {
        background-color: #dc3545;
    }
    .action-btn.delete:hover {
        background-color: #c82333;
    }
    .add-form, .edit-form {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
    .add-form h2, .edit-form h2 {
        color: #28a745;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .form-input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }
    .form-input:focus {
        border-color: #007bff;
    }
    button[type="submit"] {
        padding: 12px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #218838;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Inventory Management</h1>
    
    <!-- Search Form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by name" class="search-box" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="search-btn"><i class="fas fa-search"></i> Search</button>
    </form>

    <!-- Inventory Table -->
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Warehouse ID</th>
                <th>Storage Quantity (KG)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $item): ?>
                <tr>
                    <td><?= $item['PrimaryID'] ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['warehouseID']) ?></td>
                    <td><?= $item['storage_quantity_kg'] ?></td>
                    <td>
                        <a href="?edit=<?= $item['PrimaryID'] ?>" class="action-btn"><i class="fas fa-edit"></i> Edit</a>
                        <a href="?delete=<?= $item['PrimaryID'] ?>" class="action-btn delete"><i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Inventory Form -->
    <form method="POST" class="add-form">
        <h2>Add Inventory Item</h2>
        <input type="text" name="name" class="form-input" placeholder="Item Name" required>
        <input type="text" name="warehouseID" class="form-input" placeholder="Warehouse ID" required>
        <input type="number" name="storage_quantity_kg" class="form-input" placeholder="Storage Quantity (KG)" step="0.01" required>
        <button type="submit" name="add">Add Item</button>
    </form>

    


    
    <!-- Edit Inventory Form -->
    <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM inventory WHERE PrimaryID = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="POST" class="edit-form">
            <h2>Edit Inventory Item</h2>
            <input type="hidden" name="id" value="<?= $item['PrimaryID'] ?>">
            <input type="text" name="name" class="form-input" value="<?= htmlspecialchars($item['name']) ?>" required>
            <input type="text" name="warehouseID" class="form-input" value="<?= htmlspecialchars($item['warehouseID']) ?>" required>
            <input type="number" name="storage_quantity_kg" class="form-input" value="<?= $item['storage_quantity_kg'] ?>" step="0.01" required>
            <button type="submit" name="edit">Update Item</button>
        </form>
    <?php endif; ?>
</div>
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
