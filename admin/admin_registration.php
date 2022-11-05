<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/logo.jpg" alt="Admin registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" require="required" class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email" require="required" class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" name="password" placeholder="Enter your password" require="required" class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="text" id="confirm_password" name="confirm_password" placeholder="Enter your password" require="required" class="form-control" required>
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
//php code to send admin registration number
if (isset($_POST['admin_registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $hash_password = password_hash($pw, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['confirm_password'];


$select_query = "Select * from `admin_table` where admin_name='$username' or admin_email='$email'";
$result = mysqli_query($con, $select_query);
$rows_count = mysqli_num_rows($result);
if ($rows_count > 0) {
    echo "<script>alert('Username and email already exist')</script>";
} else if ($pw != $conf_user_password) {
    echo "<script>alert('Passwords don't match')</script>";
} else {
    $insert = "insert  into `admin_table` (admin_name,admin_email,admin_password) values('$username','$email','$hash_password')";
    $result_query = mysqli_query($con, $insert);
    if ($result_query == $insert) {
        echo "<script>alert('Registered Successfully')</script>";
        echo "<script>window.open('admin_login.php','_self')</script>";
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}
}
?>