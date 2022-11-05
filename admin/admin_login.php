<?php include('../includes/connect.php');
include('../functions/common_function.php');
@ session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/logo.jpg" alt="Admin Login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" require="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" name="password" placeholder="Enter your password" require="required" class="form-control">
                    </div>

                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<?php

if (isset($_POST['admin_login'])) {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    $select_query = "select * from `admin_table` where admin_name='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;

        if (password_verify($user_password, $row_data['admin_password'])) {
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php', '_self')</script>";

        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }

    } 
    else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>