<?php
    include_once 'database.php';
    session_start();

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("Location: login.php");
    }
      //connect db
    $sql = "SELECT * FROM bank"; //เรียกข้อมูลมาแสดงทั้งหมด
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
        <a class="navbar-brand" href="./index.php">Shoes Cafe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="./men.php">สินค้าผู้ชาย</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./women.php">สินค้าผู้หญิง</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./kid.php">สินค้าเด็ก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./howtobuy.php">วิธีการสั่งซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./contract.php">ติดต่อเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./cart.php">ตะกร้าสินค้า</a>
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
            <h3>ธนาคารที่สามารถชำระได้</h3>
            <?php
                while($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-4">
                    <div class="type-shoes">
                        <img style="width: 30%" src="img/<?php echo $row["Bank_Name"];?>.jpg" alt="">
                    </div>
                    <p><b><?php echo $row["Bank_Name"]; ?></b></p>
                    <p><?php echo $row["Bank_Owner"]; ?></p>
                    <p><?php echo $row["Bank_Num"]; ?></p>
                    <p><?php echo $row["Bank_Branch"]; ?></p>
                    <p><?php echo $row["Bank_Type"]; ?></p>
                    </div>
            <?php
                    }
            ?>
            <h3>แนบเอกสารการโอน</h3>
            <form  action="">
                <span>ชื่อบัญชีผู้โอน</span><input class="form-control" id="" name="" type="text">
                <span>ธนาคาร</span><select class="form-control" name="ฺBank_Name" id="Bank_Name">
                    <option value="กรุงเทพ">กรุงเทพ</option>
                    <option value="กรุงไทย">กรุงไทย</option>
                    <option value="กสิกร">กสิกร</option>
                    <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>

                </select>
                <span>แนบหลักฐานการชำระเงิน</span><input class="form-control" type="file">
                <span>วันที่โอน</span><input class="form-control" type="date">
                <span>เวลาที่โอน</span><input  class="form-control" type="time">
                <span>รหัสอ้างอิง</span><input  class="form-control" type="text"> <br>
                <input class="btn btn-success" type="submit" value="ยืนยันการโอน">
            </form>
        </div>
    </div>
    </section>



    
    <footer>

    </footer>
</body>
</html>