<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!doctype html>
<html>

<head>
  <title>Wearables</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
      <img src="./images/logo.jpg" class="logo" alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="display_all.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item() ?></sup></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
          </li>
        </ul>
        <form class="d-flex" action="search_products.php" method="get">
          <input name="search_data" class="form-control me-2" type="search" placeholder="Search.." aria-label="Search">
          <input type="submit" name="search_data_product" value="Search" class="btn btn-outline-light">
        </form>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">

      <?php
      if (!isset($_SESSION['username'])) {
        echo "  <li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
      } else {
        echo " <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
        </li>";
      }
      if (!isset($_SESSION['username'])) {
        echo " <li class='nav-item'>
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>
            </li>";
      } else {
        echo " <li class='nav-item'>
                <a class='nav-link' href='users_area/logout.php'>Logout</a>
            </li>";
      }
      ?>
    </ul>
  </nav>
  <?php
  //calling cart function
  cart();
  ?>
  <div class="bg-light">
    <h3 class="text-center">Gravin'S Store</h3>
    <p class="text-center">Communication is at the heart of e-commerce and community</p>
  </div>
  <div class="row px-3">
    <div class="col-md-10">
      <!---products-->
      <div class="row">

        <!--- fetching products from the database tobe displayed -->
        <?php
        //function calling
        view_details();
        get_unique_categories();
        get_unique_brands()
        ?>
      </div>
    </div>
    <!--- sidebar -->
    <div class="col-md-2 bg-secondary p-0">
      <!--brands displayed -->
      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light">
            <h4>Delivery Brands</h4>
          </a>
        </li>
        <!--- collect data from db -->
        <?php
        getbrands();
        ?>

      </ul>
      <!--- categories tobe displayed -->
      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light">
            <h4>Categories</h4>
          </a>
        </li>
        <!--- collect data from db -->
        <?php
        getcategories();
        ?>
      </ul>
    </div>
  </div>


  <?php include("./includes/footer.php") ?>

  </div>
</body>

</html>