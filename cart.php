<?php
include('includes/connect.php');
include('functions/common_function.php');
?>

<!doctype html>
<html>
<head>
<title>cart_totals</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
<style>
    .cart-img{
    width: 80px;
    height: 80px;
    object-fit: contain;
}
</style>
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
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item() ?></sup></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">
  <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
  </ul>
</nav>
<?php 
          //calling cart function
cart();
?>


<div class="bg-light">
  <h3 class="text-center">Hidden Store</h3>
  <p class="text-center">Communication is at the heart of e-commerce and community</p>
</div>


<div class="container">
    <div class="row">
      <form action="" method="POST">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                <!---php code to display dynamic data -->
                <?php
                global $con;
                $total_price=0;
                $get_ip_add = getIpAddress();
                $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
                $result=mysqli_query($con,$cart_query);
                while($row=mysqli_fetch_array($result)){
                    $product_id=$row['product_id'];
                    $select_products="select * from `products` where product_id='$product_id'";
                    $result_products=mysqli_query($con,$select_products);
                    while($row_product_price=mysqli_fetch_array($result_products)){
                      $product_price=array($row_product_price['product_price']);
                      $price_table=$row_product_price['product_price'];
                      $product_title=$row_product_price['product_title'];
                      $product_image1=$row_product_price['product_image1'];
                      $product_values=array_sum($product_price);
                      $total_price+=$product_values;
                ?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./images/<?php echo $product_image1?>" alt="" class="cart-img"></td>
                    <td><input type="text" name="qty" id="" class="form-input w-50"></td>
                    <?php
          $get_ip_add = getIpAddress();
          echo "My Ip address is: $get_ip_add";

          if(isset($_POST['update_cart'])){
            $quantities=$_POST['qty'];
            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add' ";
            $result_products_qty=mysqli_query($con,$update_cart);
            $total_price=$total_price*$quantities;
          } 


                    ?>
                    <td><?php echo $price_table ?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!--<button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                        <input type="submit" value="update cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                    </td>
                    <td>
                        <input type="submit" value="Remove cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">

                    </td>
                </tr>

                <?php 
                }
            }
                ?>
            </tbody>
        </table>

        <div class="d-flex mb-5">
            <h4 class="px-3">Subtotal: <strong class="text-info" ><?php echo $total_price ?>/-</strong></h4>
            <a href="index.php"><button class="bg-info px-3 py-2 border-0 mx-3">Continue Shopping</button></a>
            <a href="#"><button class="bg-secondary p-3 py-2 border-0 text-light">Checkout</button></a>

        </div>
    </div>
</div>
</form>


<!-- function to remove items-->
<?php
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])){
    foreach($_POST['removeitem'] as $remove_id){
      echo $remove_id;
      $delete_query="Delete from `cart_details` where product_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
}
echo $remove_item=remove_cart_item();
?>
<?php include("./includes/footer.php") ?>

</div>
</body> 
</html>
    