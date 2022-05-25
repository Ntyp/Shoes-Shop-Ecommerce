<?php
include_once 'database.php';
session_start();
     $Coupon_Code = $_POST['Coupon_Code'];
	  $Coupon_Price = $_POST['Coupon_Price'];
	  $Coupon_Quantity = $_POST['Coupon_Quantity'];
	 $sql = "INSERT INTO coupon (Coupon_Code,Coupon_Price,Coupon_Quantity)
	 VALUES ('$Coupon_Code','$Coupon_Price','$Coupon_Quantity')";
     if ($conn->query($sql) === TRUE) {
        header("Location: coupon.php");
    }
    else {
        echo "Error";
    }
     
?>