<?php
    include_once 'database.php';
    session_start();
    $order_id = $_GET['order_id'];
    $sql = "SELECT * FROM payment_order WHERE order_id = $order_id";
    $result = $conn->query($sql);
    
    if(isset($_POST['submit_payment'])) {
        // echo $order_id;
        // =======================
        // =======================
        $update = "UPDATE order_head SET order_status = 'ชำระเงินสำเร็จ' WHERE order_id = $order_id";
        $resultupdate = mysqli_query($conn,$update);
        

        // หาว่ามีตัวไหนใน order_id บ้าง
        $find = "SELECT * FROM order_detail WHERE order_id = $order_id";
        $resultfind = mysqli_query($conn,$find);
        while($rowfind = mysqli_fetch_array($resultfind, MYSQLI_ASSOC)){
            $Code_Fake = $rowfind['product_ID'];
            $Size_Fake = $rowfind['detail_size'];
            $Color_Fake = $rowfind['detail_color'];
            $Qty_Fake = $rowfind['detail_qty'];
            $minus = "UPDATE stock_product SET Quatity = Quatity -'$Qty_Fake'  WHERE Code = '$Code_Fake' 
            AND Size = '$Size_Fake' AND Color = '$Color_Fake'";
            echo $minus;
            $resultminus = mysqli_query($conn,$minus);
        }
        echo '<script>alert("อัปเดตสถานะสำเร็จ");location.href="mange_order.php";</script>';

    }
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
                    <li><a class="dropdown-item" href="./stock.php">คลังสินค้า</a></li>
                    <li><a class="dropdown-item" href="./update_status.php">คำสั่งซื้อ</a></li>
                    <li><a class="dropdown-item" href="./coupon.php">คูปองส่วนลด</a></li>
                    <li><a class="dropdown-item" href="./aleart_product.php">สินค้าใกล้หมด</a></li>
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
              <div class="col-md-12 table-responsive">
              <h3>แจ้งการชำระเงิน</h3>
                <form action="" method="post">
                    <table  class="table table-bordered">
                        <tr>
                            <?php
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            ?>
                            <td align='center'>หมายเลขคำสั่งซื้อ</td>
                            <td><?php echo $row['order_id'] ?></td> 
                        </tr>
                        <tr>
                            <td align='center'>ไอดีลูกค้า</td>
                            <td><?php echo $row['payment_owner'] ?></td>
                        </tr>
                        <tr>
                            <td align='center'>ยอดรวม</td>
                            <td><?php echo number_format($row['payment_total'],2) ?></td>
                        </tr>
                        <tr>
                            <td align='center'>โอนจากธนาคาร</td>
                            <td><?php echo $row['payment_bank'] ?></td>
                        </tr>
                        <tr>
                            <td align='center'>วันที่โอน</td>
                            <td><?php echo $row['payment_date'] ?></td>
                        </tr>
                        <tr>
                        <td align='center'>รูป</td>
                            <td><img style="width:50%" src="./img/<?php echo $row['payment_img'] ?>" alt=""></td>
                        </tr>
                            <?php
                                }
                            ?>            
                    </table>
                    <br>
                    <center><input style="width:100%" name="submit_payment" id="submit_payment"  class="btn btn-success" type="submit" value="ยืนยันการชำระเงิน"></center>
                </form>
              </div>
              
          </div>
      </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>

<!-- 
                     -->