<?php
session_start();

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

// Handle Add, Edit, Delete Operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $delivery_date = $_POST['delivery_date'];

        // Check for duplicate name
        $checkStmt = $pdo->prepare("SELECT * FROM logistics WHERE name = ?");
        $checkStmt->execute([$name]);

        if ($checkStmt->rowCount() > 0) {
            $_SESSION['message'] = "Product already exists!";
            $_SESSION['type'] = "error";
        } else {
            $stmt = $pdo->prepare("INSERT INTO logistics (name, delivery_date) VALUES (?, ?)");
            $stmt->execute([$name, $delivery_date]);
            $_SESSION['message'] = "Product added successfully!";
            $_SESSION['type'] = "success";
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $delivery_date = $_POST['delivery_date'];

        $stmt = $pdo->prepare("UPDATE logistics SET name = ?, delivery_date = ? WHERE LogisticID = ?");
        $stmt->execute([$name, $delivery_date, $id]);

        $_SESSION['message'] = "Product updated successfully!";
        $_SESSION['type'] = "success";
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM logistics WHERE LogisticID = ?");
    $stmt->execute([$id]);

    $_SESSION['message'] = "Product deleted successfully!";
    $_SESSION['type'] = "success";
}

// Fetch Logistics Data
$search = $_GET['search'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM logistics WHERE name LIKE ?");
$stmt->execute(['%' . $search . '%']);
$logistics = $stmt->fetchAll(PDO::FETCH_ASSOC);

$editingLogistic = null;
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM logistics WHERE LogisticID = ?");
    $stmt->execute([$editId]);
    $editingLogistic = $stmt->fetch(PDO::FETCH_ASSOC);
}
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
                    <a href="../pages/WareHouseManagerDashboard.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> HOME </a>
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
                    <a href="../pages/wareHouseNoti.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>NOTIFICATION</a>
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


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
         max-width: 800px;
         margin: 50px auto;
         background: white;
         border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         padding: 20px;
     }
     h1 {
         text-align: center;
         color: #333;
     }
     .alert {
         padding: 10px;
         margin-bottom: 15px;
         border-radius: 4px;
         text-align: center;
         font-size: 14px;
     }
     .alert.success {
         background-color: #d4edda;
         color: #155724;
     }
     .alert.error {
         background-color: #f8d7da;
         color: #721c24;
     }
     .search-form {
         display: flex;
         justify-content: center;
         margin-bottom: 20px;
     }
     .search-box {
         width: 70%;
         padding: 8px;
         font-size: 14px;
         border: 1px solid #ddd;
         border-radius: 4px;
     }
     .search-btn {
         padding: 8px 15px;
         font-size: 14px;
         color: white;
         background-color: #007bff;
         border: none;
         border-radius: 4px;
         margin-left: 5px;
         cursor: pointer;
     }
     table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
     }
     table th, table td {
         padding: 12px;
         text-align: center;
         border: 1px solid #ddd;
     }
     table th {
         background-color: #007bff;
         color: white;
     }
     .action-btn {
         padding: 5px 10px;
         text-decoration: none;
         color: white;
         background-color: #28a745;
         border-radius: 4px;
     }
     .action-btn.delete {
         background-color: #dc3545;
     }
     .form-container {
         margin-top: 20px;
         background-color: #f1f1f1;
         padding: 15px;
         border-radius: 4px;
     }
     .form-container h2 {
         margin-bottom: 10px;
     }
     .form-container input, .form-container button {
         width: calc(100% - 20px);
         margin: 5px 0;
         padding: 10px;
         border: 1px solid #ddd;
         border-radius: 4px;
     }
     .form-container button {
         background-color: #007bff;
         color: white;
         cursor: pointer;
     }
 </style>
</head>
<body>
 <div class="container">
     <h1>Logistics Management</h1>

     <?php if (isset($_SESSION['message'])): ?>
         <div class="alert <?= $_SESSION['type'] ?>">
             <?= htmlspecialchars($_SESSION['message']) ?>
             <?php unset($_SESSION['message'], $_SESSION['type']); ?>
         </div>
     <?php endif; ?>

     <form class="search-form" method="GET">
         <input type="text" name="search" placeholder="Search by name" class="search-box" value="<?= htmlspecialchars($search) ?>">
         <button type="submit" class="search-btn">Search</button>
     </form>

     <table>
         <thead>
             <tr>
                 <th>LogisticID</th>
                 <th>Name</th>
                 <th>Delivery Date</th>
                 <th>Actions</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($logistics as $logistic): ?>
                 <tr>
                     <td><?= $logistic['LogisticID'] ?></td>
                     <td><?= htmlspecialchars($logistic['name']) ?></td>
                     <td><?= $logistic['delivery_date'] ?></td>
                     <td>
                         <a href="?edit=<?= $logistic['LogisticID'] ?>" class="action-btn">Edit</a>
                         <a href="?delete=<?= $logistic['LogisticID'] ?>" class="action-btn delete">Delete</a>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>

     <?php if (!$editingLogistic): ?>
         <div class="form-container">
             <h2>Add Logistic</h2>
             <form method="POST">
                 <input type="text" name="name" placeholder="Name" required>
                 <input type="date" name="delivery_date" required>
                 <button type="submit" name="add">Add Logistic</button>
             </form>
         </div>
     <?php else: ?>
         <div class="form-container">
             <h2>Edit Logistic</h2>
             <form method="POST">
                 <input type="hidden" name="id" value="<?= $editingLogistic['LogisticID'] ?>">
                 <input type="text" name="name" value="<?= htmlspecialchars($editingLogistic['name']) ?>" required>
                 <input type="date" name="delivery_date" value="<?= $editingLogistic['delivery_date'] ?>" required>
                 <button type="submit" name="edit">Update Logistic</button>
             </form>
         </div>
     <?php endif; ?>
 </div>
</body>
</html>

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
 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

 
 


 <!-- Template Javascript -->
 <script src="../js/main.js"></script>
</body>

</html>




