<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    $Code = $_POST['Code'];
    $Name = $_POST['Name'];
    $Forbuy = $_POST['Forbuy'];
    $Forsell = $_POST['Forsell'];
    $Type = $_POST['Type'];
    $Detail = $_POST['Detail'];
    $Img = $_POST['Img'];
    if(isset($_POST['btnadd'])) {
        $sql = "INSERT INTO stock (product_ID,Code,Name,Forbuy,Forsell,Type,Detail,Img) VALUES (null,'$Code','$Name','$Forbuy','$Forsell','$Type',
        '$Detail','$Img')";
        
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        if($result){
            echo '<script>alert("เพิ่มสินค้าเข้าระบบสำเร็จ");location.href="mangeitem.php";</script>';
        }
        else{
            echo '<script>alert("เพิ่มสินค้าเข้าระบบผิดพลาด กรุณาลองอีกครั้ง");location.href="mangeitem.php";</script>';
        }
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
                    <li><a style="color:black" class="dropdown-item" href="./mangeitem.php">เพิ่มข้อมูสินค้า</a></li>
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
                <div class="col-md-12">
                        <h3 style="text-align: center;">เพิ่มข้อมูลสินค้า</h3>
                                    <form action="" method="POST">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <span>รหัสสินค้า</span>
                                                <input type="text" id="Code" name="Code" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>ชื่อสินค้า</span>
                                                <input type="text" id="Name" name="Name" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>ราคาต้นทุน</span>
                                                <input type="number" id="Forbuy" name="Forbuy" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>ราคาขาย</span>
                                                <input type="number" id="Forsell" name="Forsell" class="form-control" required>
                                            </div>
                                            <div class="col-md-12">
                                                <span>ประเภทสินค้า</span>
                                                <select name="Type" id="Type" class="form-control">
                                                    <option value="">กรุณาเลือกประเภท</option>
                                                    <option value="men">รองเท้าผู้ชาย</option>
                                                    <option value="women">รองเท้าผู้หญิง</option>
                                                    <option value="kid">รองเท้าเด็ก</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <span>รายละเอียดสินค้า</span>
                                                <textarea class="form-control" id="Detail" name="Detail" required></textarea>
                                            </div>
                                            <div class="col-6">
                                                <span>รูปภาพสินค้า</span>
                                                <input class="form-control" id="Img" name="Img" type="file">
                                            </div>
                                            <a href="deleteitem.php">ลบสินค้าออกจากคลัง</a>
                                            <div class="col-12 mt-5">        
                                                <input type="submit" class="btn btn-success float-end" name="btnadd" id="btnadd" value="+ เพิ่มสินค้า">                
                                                <!-- <button type="submit" class="btn btn-success float-end">+ เพิ่มสินค้า</button>
                                                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary float-end me-2 ">ยกเลิก</button> -->
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
                    
                </div>
            </div>
        </div>


    </section>
    
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>

</html>
