<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
    $product_name = $_POST['product_name'];
    $type = $_POST['type'];
    $variety = $_POST['variety'];
    $seasionality = $_POST['seasionality'];
    $h_price = $_POST['h_price'];
    $c_price = $_POST['c_price'];

    // Check if the product name already exists
    $checkQuery = "SELECT * FROM `crud` WHERE `product_name` = '$product_name'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Product already exists
        header("Location: admin_index.php?msg=Product already exists");
    } else {
        // Insert the new product
        $sql = "INSERT INTO `crud` (`id`, `product_name`, `type`, `variety`, `seasionality`, `h_price`, `c_price`) 
                VALUES (NULL, '$product_name', '$type', '$variety', '$seasionality', '$h_price', '$c_price')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: admin_index.php?msg=New record created successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>





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
                                <a href="add_new.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> PRODUCTS </a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="ProductInfo.php" class="dropdown-item">PRODUCT INFORMATION</a>
                                    <a href="ProductionData.php" class="dropdown-item">PRODUCTION DATA</a> 
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> WAREHOUSE </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="AdminInventory.php" class="dropdown-item">INVENTORY</a>
                            <a href="AdminLogistic.php" class="dropdown-item">LOGISTIC</a>
                            <!-- <a href="AdminMarketPrice.php" class="dropdown-item">MARKET PRICE</a> -->
                        
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>
                    <a href="ProductAnalysis.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i> ANALYSIS </a>
                    
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


            <!-- Sale & Revenue Start -->
             
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user-circle fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2"> কৃষক </p>
                                <h6 class="mb-0"> ৫০,০০০+ জন </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-balance-scale fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">ফসল</p>
                                <h6 class="mb-0">৩০ প্রজাতির </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
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


     <!-- FORM START -->
<br>

<div class="container">
    <!-- Form Header -->
    <div class="bg-gradient-warning p-4 rounded text-center shadow-lg mb-4" style="background: linear-gradient(90deg, #ffcc00, #ff9900); color: #fff;">
        <h3 class="fw-bold">✨ Add Your Products ✨</h3>
        <p class="text-light">Complete the form below to add your new products with all necessary details.</p>
    </div>

    <!-- Form Body -->
    <div class="container d-flex justify-content-center">
        <form action="" method="post" class="bg-light p-4 rounded shadow-sm" style="width:50vw; min-width:300px;">
            <!-- Row 1 -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label fw-bold">Product Name:</label>
                    <input type="text" class="form-control border-primary" name="product_name" placeholder="Enter Your Product Name">
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Type:</label>
                    <input type="text" class="form-control border-primary" name="type" placeholder="Enter Your Product Type">
                </div>
            </div>

            <!-- Row 2 -->
            <div class="mb-3">
                <label class="form-label fw-bold">Variety:</label>
                <input type="text" class="form-control border-primary" name="variety" placeholder="Enter Your Variety">
            </div>

            <!-- Row 3 -->
            <div class="mb-3">
                <label class="form-label fw-bold">Seasonality:</label>
                <input type="text" class="form-control border-primary" name="seasionality" placeholder="Enter Your Seasonality">
            </div>

            <!-- Row 4 -->
            <div class="mb-3">
                <label class="form-label fw-bold">Historical Price / Per KG:</label>
                <input type="text" class="form-control border-primary" name="h_price" placeholder="Enter Your Historical Price">
            </div>

            <!-- Row 5 -->
            <div class="mb-3">
                <label class="form-label fw-bold">Current Price / Per KG:</label>
                <input type="text" class="form-control border-primary" name="c_price" placeholder="Enter Your Current Price">
            </div>

            <!-- Buttons -->
            <div class="text-center">
                <button type="submit" class="btn btn-success me-2 px-4" name="submit"><i class="fas fa-save"></i> Save</button>
                <a href="admin_index.php" class="btn btn-danger px-4"><i class="fas fa-times"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>



            

 



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




