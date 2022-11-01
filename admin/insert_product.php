<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    //accessing images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    //accessing image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (  (empty($_POST["product_title"])) && (empty($_POST["product_description"])) && 
        (empty($_POST["product_keywords"])) &&  (empty($_POST["product_category"])) &&
        (empty($_POST["product_brands"])) && (empty($_POST["product_price"])) && 
        (empty($_FILES["product_image1"])) && (empty($_FILES["product_image2"])) && 
        (empty($_FILES["product_image3"])) ){

    
    echo "<script>alert('Please fill all the available fields')</script>";
  } 
  else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        $insert_query="insert into products(product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status)
            values('$product_title','$product_description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')"; 

        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Product has been inserted succcessfully')</script>";
        }  
    }
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <!--- title -->
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required>
            </div>
            <!--- description -->
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
            </div>

            <!--- keywords -->
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="product_keywords" class="form-label">keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required>
            </div>

            <!--- categories -->
            <div class="form-outline mb-4 w-4 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">select a category</option>
                    <?php
                    $select_query="select * from categories";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
            </select>
            </div>

            <!--- brands -->
            <div class="form-outline mb-4 w-4 m-auto">
                <select name="product_brands" id="" class="form-select">
                    <option value="">select a brand</option>
                    <?php
                    $select_query="select * from brands";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $brand_title=$row['brand_title'];
                        $brand_id=$row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>

            <!--- images -->
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="product_image1" class="form-label">product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="product_image2" class="form-label">product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required>
            </div>
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="product_image3" class="form-label">product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required>
            </div>

            <!--- price -->
            <div class="form-outline mb-4 w-4 m-auto">
                <label for="product_price" class="form-label"> Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required>
            </div>
            <!--- price -->
            <div class="form-outline mb-4 w-4 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert products">
            </div>
        </form>

    </div>

</body>
</html>