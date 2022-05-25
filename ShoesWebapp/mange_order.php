<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    $sql = "SELECT * FROM order_head ORDER BY order_head . order_id DESC";
    $result = mysqli_query($conn,$sql);
    // if(isset($_POST['btncancel'])) {
    //     $delete = "DELETE FROM order_head WHERE order_id = 'order_id'";
    // }

    $act = $_GET['act'];
    $order_id = $_GET['order_id'];
    if($act == 'remove') {
        // echo $order_id;
        $deleteorderdetail = "DELETE FROM order_detail WHERE order_id = '$order_id'";
        $resultdetail = mysqli_query($conn,$deleteorderdetail);
        $deleteorderhead = "DELETE FROM order_head WHERE order_id = '$order_id'";
        $resulthead = mysqli_query($conn,$deleteorderhead);
        $deletepayment = "DELETE FROM postcode_detail WHERE order_id = '$order_id'";
        $resultpayment = mysqli_query($conn,$deletepayment);
        $deletepostcode = "DELETE FROM postcode_detail WHERE order_id = '$order_id'";
        $resultpostcode = mysqli_query($conn,$deletepostcode);
        echo '<script>alert("ลบรายการสำเร็จ");location.href="mange_order.php";</script>';
    }
    
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
                    <li><a style="color:red" class="dropdown-item" href="./aleart_product.php">สินค้าใกล้หมด</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    จัดการ
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a style="color:black" class="dropdown-item" href="./mangeitem.php">เพิ่มข้อมูลสินค้า</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./mangeitem1.php">เพิ่มจำนวนสินค้า</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./mange_order.php">จัดการออเดอร์</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./mange_bank.php">จัดการบัญชีการโอน</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./mangeuser.php">เปลี่ยนระดับผู้ใช้งาน</a></li>
                    <li><a style="color:black" class="dropdown-item" href="./report_admin.php">รายงานการติดต่อ</a></li>
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
                <form action="" method="POST">
                    <table class="table table-bordered">
                        <center><h3><b>จัดการออเดอร์</b></h3></center>
                        <tr>
                            <td align='center'><b>ออเดอร์เลขที่</b></td>
                            <td align='center'><b>รายละเอียด</b></td>
                            <td align='center'><b>ผู้สั่งสินค้า</b></td>
                            <td align='center'><b>สถานะคำสั่งซื้อ</b></td>
                            <td align='center'><b>แอคชั่น</b></td>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                        
                            <td align='center'><?php echo $row['order_id']; ?></td>
                            <td align='center'><a class="btn btn-success" href="order_detail_admin.php?order_id=<?php echo $row['order_id'];?>">รายละเอียด</a></td>
                            <td align='center'><?php echo $row['order_owner'];?></td>
                            <td align='center'><?php echo $row['order_status'];?></td>
                            <td align='center'><a class="btn btn-danger" href='mange_order.php?order_id=<?php echo $row['order_id']; ?>&act=remove'>ลบ</a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>

<?php
    }
?>