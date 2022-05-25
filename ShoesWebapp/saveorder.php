<?php
    include_once 'database.php';
    session_start();

    // echo '<pre>';
    // print_r($_SESSION);
    // echo'</pre>';
    error_reporting(0);

    $user_name = $_SESSION['Username'];
    // SHOW ADDRESS USER
    $search_address = "SELECT * FROM user WHERE User_Username = '$user_name'";
    $result_address = mysqli_query($conn,$search_address);
    $row_address = mysqli_fetch_array($result_address);


    // echo $row_address['User_Address']." ".$row_address['User_Tambon']." ".$row_address['User_Amphoe']." ".$row_address['User_Province']." ".$row_address['User_Zipcode']." ".$row_address['User_Email']." ".$row_address['User_Phone'] ;


    $order_name = $_POST['order_name'];
    $order_address = $_POST['order_address'];
    $order_email = $_POST['order_email'];
    $order_phone = $_POST['order_phone'];
    $order_total = $_POST['order_total'];

    // if order_name = "" 
    if($order_name == "") {
        $order_name = $row_address['User_Firstname']." ".$row_address['User_Lastname'];
        $order_address = $row_address['User_Address']." ".$row_address['User_Tambon']." ".$row_address['User_Amphoe']." ".$row_address['User_Province']." ".$row_address['User_Zipcode'];
        $order_email = $row_address['User_Email'];
        $order_phone = $row_address['User_Phone'];
    }
    $order_status = 'ยังไม่ได้ชำระเงิน';
    $order_owner = $_SESSION['Username'];

    $sql = "INSERT INTO order_head VALUES(null,'$order_name','$order_address','$order_email','$order_phone','$order_total','$order_status','$order_owner')";
    $query = mysqli_query($conn,$sql);

    // เอาออเดอร์ล่าสุดเก็บข้อมูลลงไปยัง order_detail
    $sql2 = "SELECT MAX(order_id) AS order_id FROM order_head WHERE order_name = '$order_name' and 
    order_email = '$order_email'";
    $query2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($query2);
    $order_id = $row2["order_id"];
    // 

    // $find = "SELECT order_id FROM order_head WHERE "
    // add Color Size ด้วย


    foreach($_SESSION['cart'] as $Code=>$qty){
        // เช็คจาก Stock_product เพื่อเอา Code
        $sql3 = "SELECT * FROM stock_product  WHERE Code= '$Code'";
        $query3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($query3);           
        $sum = $_SESSION['cart'][$Code]['Forsell']*$_SESSION['cart'][$Code]['qty']  ;
        $qty1 = $_SESSION['cart'][$Code]['qty'];
        $product_ID= $_SESSION['cart'][$Code]['Code'];
        $size1 = $_SESSION['cart'][$Code]['Size'];
        $color1 = $_SESSION['cart'][$Code]['Color'];
        $sql4 = "INSERT INTO order_detail (detail_id,order_id,product_ID,detail_size,detail_color,detail_qty,detail_subtotal) VALUES 
        (null,'$order_id','$product_ID','$size1','$color1',$qty1 ,$sum)";
        $query4 = mysqli_query($conn,$sql4);
    }
    
    echo '<script>alert("ยืนยันออเดอร์ สามารถตรวจสอบคำสั่งซื้อได้ที่สถานะคำสั่งซื้อ");location.href="index.php";</script>';
    unset($_SESSION['cart']);
    // header("Location: order.php");
?>