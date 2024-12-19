<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> OFFER PRICE</title>
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
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>চাষবাস.কম</h3>
                    
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../images/FarmerDashboard/f_user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"> JABBAR </h6>
                        <span>FARMER</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="FarmerDashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> HOME </a>
                    <div class="nav-item dropdown">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> LOGISTIC </a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="DeliverySchedule.php" class="dropdown-item"> DELIVERY SCHEDULE </a>
                            </div>
                        
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>
                    <a href="OfferPriceForm.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>OFFER PRICE</a>
                    <!-- <a href="WareHouseNoti.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>NOTIFICATION</a> -->

                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> MENU </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../pages/Farmerlist.html" class="dropdown-item">FARMER LIST</a>
                            <a href="../pages/RegistrationForm.html" class="dropdown-item">REGISTRATION</a>
                            
                            
                        </div> -->
                    </div>
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
                                    <img class="rounded-circle" src="../images/FarmerDashboard/f_user.jpg"" alt="" style="width: 40px; height: 40px;">
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
                                <h6 class="fw-normal mb-0">Potato Price updated</h6>
                                <small>12 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Rice added</h6>
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
                            <img class="rounded-circle me-lg-2" src="../images/FarmerDashboard/f_user.jpg"" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"> JABBAR </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <!-- <a href="#" class="dropdown-item">My Profile</a> -->
                            <!-- <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="LogOut.php" class="dropdown-item"> LOG OUT </a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <br>

            <?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'tutorial'); // Update credentials if needed

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission (Add or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) { // Add new record
        $logistic_name = $_POST['logistic_name'];
        $remark = $_POST['remark'];
        $delivery_date = $_POST['delivery_date'];

        $stmt = $conn->prepare("INSERT INTO deliveryschedule (logistic_name, remark, delivery_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $logistic_name, $remark, $delivery_date);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) { // Update existing record
        $id = $_POST['id'];
        $logistic_name = $_POST['logistic_name'];
        $remark = $_POST['remark'];
        $delivery_date = $_POST['delivery_date'];

        $stmt = $conn->prepare("UPDATE deliveryschedule SET logistic_name = ?, remark = ?, delivery_date = ? WHERE id = ?");
        $stmt->bind_param("sssi", $logistic_name, $remark, $delivery_date, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Reload the page to avoid resubmission
    header("Location: index.php");
    exit();
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM deliveryschedule WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Reload the page after deletion
    header("Location: index.php");
    exit();
}

// Fetch all records
$result = $conn->query("SELECT * FROM deliveryschedule");

// Handle edit action (pre-fill the form)
$editMode = false;
if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $record = $conn->query("SELECT * FROM deliveryschedule WHERE id = $id")->fetch_assoc();
}
?>

    <style>
        body {
            /* font-family: Arial, sans-serif; */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        form {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions button {
            width: auto;
            padding: 5px 10px;
            margin: 0 5px;
        }
        .actions .edit {
            background-color: #28a745;
        }
        .actions .delete {
            background-color: #dc3545;
        }
        .actions .edit:hover {
            background-color: #218838;
        }
        .actions .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $editMode ? 'Edit Schedule' : 'Add Schedule' ?></h1>
        <form method="post">
            <?php if ($editMode): ?>
                <input type="hidden" name="id" value="<?= $record['id'] ?>">
            <?php endif; ?>

            <label for="logistic_name">Logistic Name:</label>
            <input type="text" id="logistic_name" name="logistic_name" value="<?= $editMode ? htmlspecialchars($record['logistic_name']) : '' ?>" required>

            <label for="remark">Remark:</label>
            <textarea id="remark" name="remark" rows="4"><?= $editMode ? htmlspecialchars($record['remark']) : '' ?></textarea>

            <label for="delivery_date">Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" value="<?= $editMode ? htmlspecialchars($record['delivery_date']) : '' ?>" required>

            <button type="submit" name="<?= $editMode ? 'update' : 'add' ?>">
                <?= $editMode ? 'Update Schedule' : 'Add Schedule' ?>
            </button>
        </form>

        <h2>Current Schedules</h2>
        <table>
            <thead>
                <tr>
                    <th>Logistic Name</th>
                    <th>Remark</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['logistic_name']) ?></td>
                            <td><?= htmlspecialchars($row['remark']) ?></td>
                            <td><?= htmlspecialchars($row['delivery_date']) ?></td>
                            <td class="actions">
                                <a href="?edit=<?= $row['id'] ?>"><button type="button" class="edit">Edit</button></a>
                                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                                    <button type="button" class="delete">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No schedules found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>




           


            <!-- Footer Start -->
            <!-- <div class="container-fluid pt-4 px-4">
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
            </div> -->
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div> -->

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

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>