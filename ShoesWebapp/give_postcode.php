<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    $order_id = $_GET['order_id'];


    
    if(isset($_POST['btn_postcode'])) {
        $postcode_code = $_POST['postcode_code'];
        $sql = "INSERT INTO postcode_detail (postcode_id,order_id,postcode_code) VALUES
        (null,'$order_id','$postcode_code')";
        $result = mysqli_query($conn,$sql);

        $update = "UPDATE order_head SET order_status = 'พัสดุถูกจัดส่งเรียบร้อย' WHERE order_id = $order_id";
        $resultupdate = mysqli_query($conn,$update);
        echo '<script>alert("อัปเดตเลขพัสดุสินค้าสำเร็จ");location.href="mange_order.php";</script>';
    }
    // POSTCODE
    $searchpost = "SELECT * FROM postcode_detail WHERE order_id = '$order_id'";
    $resultpost = mysqli_query($conn,$searchpost);
    $rowpost = mysqli_fetch_array($resultpost);


    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("Location: login.php");
    }
    if(!$_SESSION['Status'] == "Admin") {
        header("Location: index.php");
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="stylesheet" href="./css/style.css">
    <title>Shoes Cafe</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./admin.php">Admin Zone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    สินค้า
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a style="color:black"  class="dropdown-item" href="./stock.php">คลังสินค้า</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./coupon.php">คูปองส่วนลด</a></li>
                    <li><a style="color:red" class="dropdown-item" href="./aleart_product.php">สินค้าใกล้หมด</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    จัดการ
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="./mangeitem.php">เพิ่มข้อมูลสินค้า</a></li>
                    <li><a class="dropdown-item" href="./mangeitem1.php">เพิ่มจำนวนสินค้า</a></li>
                    <li><a class="dropdown-item" href="./mange_order.php">จัดการออเดอร์</a></li>
                    <li><a class="dropdown-item" href="./mange_bank.php">จัดการบัญชีการโอน</a></li>
                    <li><a class="dropdown-item" href="./mangeuser.php">เปลี่ยนระดับผู้ใช้งาน</a></li>
                    <li><a class="dropdown-item" href="./report_admin.php">รายงานการติดต่อ</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex">

                <a href="index.php?logout='1'" style="color: red;"><span>ออกจากระบบ</span></a>
        </form>
        </div>
    </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="" method="POST">
                        <h3><b>แจ้งเลขพัสดุส่งสินค้า</b></h3>

                        <?php
                            if($rowpost['postcode_code'] == '') {
                        ?>
                            <p>กรอกหมายเลขพัสดุจัดส่งสินค้าออเดอร์ที่ <b style="color:red"><?php echo $order_id; ?></b></p>
                            <input class="form-control" name="postcode_code" id="postcode_code" value="" type="text"><br>
                            <input style="width:100%" name="btn_postcode" id="btn_postcode" class="btn btn-success" type="submit" value="ยืนยัน">
                        <?php
                            }
                        ?>                      
                        <p>เลขพัสดุ: <?php echo $rowpost['postcode_code'] ?> </p>
                    </form>
                </div>
                <div class="col">
                <center><img style="width:100%" src="./img/3683230.jpg" alt=""></center>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>

<?php
    }
?>