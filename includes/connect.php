<?php
    $user = "root";
    $password = "";
    $database = "Mystore";
    $host = "localhost";

    $con=mysqli_connect($host, $user, $password, $database);
    if(!$con){
        die("Connection failed: " . mysqli_connect_error()); 
    }

?>