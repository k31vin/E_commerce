<?php 
if(isset($_GET['edit_brands'])){
    $edit_brand=$_GET['edit_brands'];

    $edit_brands="select * from `brands` where brand_id='$edit_brand'";
    $result =mysqli_query($con,$edit_brands);
    $row=mysqli_fetch_array($result);
    $brand_title=$row['brand_title'];

}
if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];
    $update_query="update `brands` set brand_title='$brand_title' where brand_id=$edit_brand";
    $result_brand =mysqli_query($con,$update_query);
    if($result_brand){
        echo "<script>alert('Brand has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')";
    }
}

?> 




<div class="container mt-3">
    <h2 class="text-center text-info">Edit Brand</h2>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label text-info">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" value="<?php echo $brand_title; ?>" require="required">
        </div>
        <input type="submit" value="Update brand" name="edit_brand" class="btn btn-info px-3 mb-3">
    </form>
</div>