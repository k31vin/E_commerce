<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!doctype html>
<html>

<head>
    <title>Welcome <?php echo $_SESSION['username']; ?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <style>
        .profile_img {
            width: 90%;
            margin: auto;
            display: block;
            /*height: 100%;*/
            object-fit: contain;
        }
        .edit_image{
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo.jpg" class="logo" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item() ?></sup></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                    </li>
                </ul>
                <form class="d-flex" action="../search_products.php" method="get">
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


    <div class="row">
        <div class="col-md-2">
            <ul class="navbar-nav bg-secondary text-center" style="height: 100vh;">
                <li class="nav-item bg-info">
                    <a class="nav-link text-light" href="#">
                        <h4>Your Profile</h4>
                    </a>
                </li>

                <?php
                $username = $_SESSION['username'];
                $user_image = "select * from `user_table` where username='$username'";
                $user_image = mysqli_query($con, $user_image);
                $row_image = mysqli_fetch_array($user_image);
                $user_image = $row_image['user_image'];
                echo "<li class='nav-item'>
                <img src='./user_images/$user_image' class='profile_img my-4'>
            </li>"

                ?>


                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php">
                        Pending Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?edit_account">
                        Edit Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?my_orders">
                        My Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?delete_account">
                        Delete Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">
                        Logout
                    </a>
                </li>
            </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php 
                get_user_order_details();
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                    include('user_orders.php');
                }
                if(isset($_GET['delete_account'])){
                    include('delete_account.php');
                }
                ?>
            </div>
    </div>
    <?php include("../includes/footer.php") ?>

    </div>
</body>

</html>