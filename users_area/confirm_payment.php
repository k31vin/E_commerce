<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    //query
    $select_data = "select * from `user_orders` where order_id=$order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}
if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "insert into `user_payments` (order_id,invoice_number,amount,payment_mode)
    values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<script>alert('<h3 class='text-center text-light>Successfully completed the payment')</script></h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
</head>

<body class='bg-secondary'>
    <div class="container my-5">
        <h1 class="text-center text-light">
            Confirm Payment
        </h1>

        <form action="" method="POST">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" name="payment_mode">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Payoffline</option>
                </select>
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="Submit" class="form-control w-50 m-auto" value="Confirm" name="confirm_payment">
            </div>

        </form>
    </div>

</body>

</html>