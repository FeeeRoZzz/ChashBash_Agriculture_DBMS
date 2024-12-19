<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ADMIN : Product Info</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

    <!-- Custom Styles -->
    <style>
        html, body {
            height: 100%;
        }

        .content {
            min-height: 80vh;
        }

        .table-container {
            margin-top: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .half-width-button {
            width: 49%;
        }

        .highlight {
            background-color: yellow;
        }
    </style>
</head>

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
            <!-- Navbar -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container">
                <h3 class="text-center mt-4 mb-4">Product Information</h3>

                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Search Form -->
                <form action="" method="GET" class="d-flex search-bar">
                    <input type="text" name="search" class="form-control" placeholder="Search Product" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>

                        <div class="d-flex justify-content-center">
            <a href="add_new.php" class="btn btn-danger mb-3 w-50">Add New Product</a>
        </div>


                <div class="table-container">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Variety</th>
                                <th>Seasonality</th>
                                <th>Historical Price</th>
                                <th>Current Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $stmt = $conn->prepare("SELECT * FROM `crud` WHERE `product_name` LIKE ?");
                            $searchParam = "%$search%";
                            $stmt->bind_param("s", $searchParam);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['variety'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['seasionality'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['h_price'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['c_price'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
