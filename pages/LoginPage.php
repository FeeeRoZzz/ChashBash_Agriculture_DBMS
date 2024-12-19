<?php

$host="localhost";
$user="root";
$password="";
$db="user";


session_start();




$data=mysqli_connect($host,$user,$password,$db);
if($data===false)
{
    die("connection_error");
}


if($_SERVER["REQUEST_METHOD"]==="POST")

{
    $username=$_POST["username"];
    $password=$_POST["password"];



    $sql="select * from login where username='".$username."' AND  password='".$password."'
    ";

    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["usertype"]=='farmer')
    {
        $_SESSION["username"]=$username;
        header("location:FarmerDashboard.php");
    }


    elseif($row["usertype"]=='manager')
    {
        $_SESSION["username"]=$username;
        header("location:WareHouseManagerDashboard.php");
    }

    

    elseif($row["usertype"]=='admin')
    {
        $_SESSION["username"]=$username;
        header("location:admin_index.php");
    }

    elseif($row["usertype"]=='fso')
    {
        $_SESSION["username"]=$username;
        header("location:FSO_Dashboard.php");
    }

    elseif($row["usertype"]=='amr')
    {
        $_SESSION["username"]=$username;
        header("location:AMR_Dashboard.php");
    }

    else 
    {
        echo "username or password incorrect";
    }

}




?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> চাষবাস : লগিন </title>

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
                        <a class="nav-link custom-btn custom-border-btn btn" href="RegisterPage.php">REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12">
                    <form action="#" method="post" class="p-4 bg-white shadow rounded">
                        <h3 class="text-center mb-4">Login</h3>
                        <div class="mb-3">
                            <label for="username" class="form-label"><b>Username</b></label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><b>Password</b></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                            <a href="#" class="text-primary">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="RegisterPage.php" class="text-primary">Register Now</a></p>
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


    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>