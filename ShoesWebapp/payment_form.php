<?php
    include_once 'database.php';
    session_start();

    $order_id = $_GET['order_id'];
    $bank_tranfer = $_POST['bank_tranfer'];
    $order_total = $_POST['order_total'];
    $bank_img = $_POST['bank_img'];
    $sql1 = "INSERT INTO payment_order VALUES (null,'$order_id','$order_total','$bank_tranfer','$bank_img') 
    WHERE order_id = $order_id";
    $result1 = mysqli_query($conn, $sql1);

?>