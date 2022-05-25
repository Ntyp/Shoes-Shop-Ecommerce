<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    
    $sql = "SELECT * FROM stock";
    $result = mysqli_query($conn,$sql);

    
    if(isset($_POST['btndelete'])) {
        $Code = $_POST['Code'];
        $delete = "DELETE FROM stock WHERE Code = '$Code'";
        echo $delete;
        $resultdelete = mysqli_query($conn,$delete);
        echo '<script>alert("ลบสินค้าสำเร็จ");location.href="deleteitem.php";</script>';
        
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
                    <li><a style="color:black"  class="dropdown-item" href="./stock.php">คลังสินค้า</a></li>
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
                <h3><b>ลบสินค้าออกจากคลัง</b></h3>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-4">
                            <select class="form-control" name="Code" id="Code">
                            <?php
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row['Code'] ?>"><?php echo $row['Code'] ." ". $row['Name'] ?></option>
                            <?php
                                } 
                            ?>
                            </select>
                        </div>
                        <div class="col">
                            <input name="btndelete" id="btndelete" class="btn btn-danger" type="submit" value='ลบ'>
                        </div>
                        <a class="mt-2" href="mangeitem.php">เพิ่มข้อมูลสินค้า</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>

</html>
