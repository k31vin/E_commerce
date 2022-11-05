<?php 
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];

    $get_categories="select * from `categories` where category_id='$edit_category'";
    $result =mysqli_query($con,$get_categories);
    $row=mysqli_fetch_array($result);
    $category_title=$row['category_title'];

}
if(isset($_POST['edit_category'])){
    $cat_title=$_POST['category_title'];
    $update_query="update `categories` set category_title='$cat_title' where category_id=$edit_category";
    $result_cat =mysqli_query($con,$update_query);
    if($result_cat){
        echo "<script>alert('Category has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')";
    }
}

?> 




<div class="container mt-3">
    <h2 class="text-center text-info">Edit Category</h2>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label text-info">Category Title</label>
            <input type="text" name="category_title" id="category_title" class="form-control" value="<?php echo $category_title; ?>" require="required">
        </div>
        <input type="submit" value="Update category" name="edit_category" class="btn btn-info px-3 mb-3">
    </form>
</div>