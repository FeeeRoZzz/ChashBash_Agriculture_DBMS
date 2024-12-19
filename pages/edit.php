<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $product_name = $_POST['product_name'];
   $type = $_POST['type'];
   $variety = $_POST['variety'];
   $seasionality = $_POST['seasionality'];
   $h_price = $_POST['h_price'];
   $c_price = $_POST['c_price'];

  $sql = "UPDATE `crud` SET `product_name`='$product_name',`type`='$type',`variety`='$variety',`seasionality`='$seasionality' , `c_price`='$c_price' ,`h_price`='$h_price'  WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: admin_index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    EDIT TABLE DATA & INFORMATION
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Table Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

<div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Product Name : </label>
                  <input type="text" class="form-control" name="product_name" value=<?php echo $row['product_name'] ?>>
               </div>

               <br>

               <div class="col">
                  <label class="form-label">Type : </label>
                  <input type="text" class="form-control" name="type" value=<?php echo $row['type'] ?>>
            </div>

            <div class="col">
                  <label class="form-label"> Variety : </label>
                  <input type="text" class="form-control" name="variety" value=<?php echo $row['variety'] ?>>
               </div>

               <br>


               <div class="col">
                  <label class="form-label"> Seasionality : </label>
                  <input type="text" class="form-control" name="seasionality" value=<?php echo $row['seasionality'] ?>>
               </div>

               <br>


               <div class="col">
                  <label class="form-label"> Historical Price / Per KG : </label>
                  <input type="text" class="form-control" name="h_price" value=<?php echo $row['h_price'] ?>>
               </div>

               <br>

               <div class="col">
                  <label class="form-label"> Current Price / Per KG : </label>
                  <input type="text" class="form-control" name="c_price" value=<?php echo $row['c_price'] ?>>
               </div>

               <br>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="admin_index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>