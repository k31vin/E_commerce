<h3 class="text-center text-success">All brands</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>SIno</th>
            <th>Brand title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_cart = "select * from `brands`";
        $result = mysqli_query($con, $select_cart);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            $number++;



        ?>
            <tr class="text-center">
                <td><?php echo $number ?></td>
                <td><?php echo $brand_title ?></td>
                <td><a href='index.php?edit_brands=<?php echo $brand_id ?>' class='text-light'>e<i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_brands=<?php echo $brand_id ?>' type="button" class="text-light" data-bs-toggle="modal" data-bs-target="#exampleModal" class='text-light'><i class='fa-solid fa-trash'>d</i></a></td>
            </tr>
        <?php  } ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <h4>Are you sure you want to delete this? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./index.php?view_brands" class='text-light text-decoration-none'></a> No</button>
                <button type="button" class="btn btn-primary"><a href='index.php?delete_brands=<?php echo $brand_id ?>' type="button" class="text-light  text-decoration-none"  data-bs-toggle="modal" data-bs-target="#exampleModal">Yes</a></button>
            </div>
        </div>
    </div>
</div>