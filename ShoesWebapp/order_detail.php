<?php
    include_once 'database.php';
    session_start();

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("Location: login.php");
    }
      //connect db
    $sql = "SELECT * FROM stock"; //เรียกข้อมูลมาแสดงทั้งหมด
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <div class="table-responsive">
            <table class="table table-bordered">
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            
                            <td><?php echo $row["Name"]?></td>
                            <td><?php echo $row["Quatity"]?></td>
                            <td><?php echo $row["Forsell"]?></td>
                        </tr>
                        <?php
                            }
                        ?>
            </table>
        </div>
        <h3>ราคาที่ต้องชำระทั้งสิ้น</h3>
        <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>รวมราคาสินค้า</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ค่าจัดส่งสินค้า</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ส่วนลด</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รวามราคาทั้งสิ้น</th>
                            <td></td>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <td><?php echo $row["Img"]?></td>
                            <td><?php echo $row["Code"]?></td>
                            <td><?php echo $row["Name"]?></td>
                            <td><?php echo $row["Quatity"]?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
        </div>
        <center>
            <a href="#">พิมพ์ใบเสร็จการชำระเงิน</a><br>
            <a class="btn btn-success" href="payment_detail.php">แนบหลักฐานการชำระเงิน</a>
        </center>
    </div>
    </section>



    
    <footer>

    </footer>
</body>
</html>