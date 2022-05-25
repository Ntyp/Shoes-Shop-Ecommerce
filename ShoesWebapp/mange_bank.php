<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    $sql = "SELECT * FROM bank";
    $result = $conn->query($sql);

    $Bankname = $_POST['Bank_Name'];
    $Banknum = $_POST['Bank_Num'];
    if(isset($_POST['btndelete'])) {
        $delete = "DELTE FROM bank WHERE Bank_Name == '$Bankname' && Bank_Num == '$Banknum'";
        $resultdelete = mysqli_query($conn,$delete);
    }

    $act = $_GET['act'];
    if($act == 'remove') {
        $Bank_Num = $_GET['Bank_Num'];
        $delete = "DELETE FROM bank WHERE Bank_Num = '$Bank_Num'";
        $resultdelete = mysqli_query($conn,$delete);
        echo '<script>alert("ลบรายการสำเร็จ");location.href="mange_bank.php";</script>';
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

                    <h3>จัดการบัญชีการโอน</h3>
                        <?php
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        ?>
                        <div class="col-md-3">
                                    <form action="" method="POST">
                                        <div class="card" style="width: 15rem;" >
                                            <img src="img/<?php echo $row['Bank_Name'] ?>.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b><?php echo $row['Bank_Name'] ?></b></h5>
                                                <p><?php echo $row['Bank_Owner'] ?></p>
                                                <span><?php echo $row['Bank_Num'] ?></span>
                                                <span><?php echo $row['Bank_Branch'] ?></span>
                                                <p><?php echo $row['Bank_Type'] ?></p>
                                                <input type="hidden" name="Bankname" value="<?php echo $row['Bank_Name'] ?>"> <!-- ชื่อธนาคาร -->
                                                <input type="hidden" name="Banknum" value="<?php echo $row['Bank_Num'] ?>"> <!-- เลขบัญชี -->

                                                <!-- ************** -->
                                                <!-- ยังแก้ปุ่มลบข้อมูลไม่ได้ -->
                                                <!-- ************** -->
                                                <a class="btn btn-danger" href='mange_bank.php?Bank_Num=<?php echo $row['Bank_Num']; ?>&act=remove'>ลบข้อมูล</a>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                        <?php
                            }
                        ?>
                </div>
                    

            </div>
              
            
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <h3 style="text-align: center;">เพิ่มข้อมูลสินค้า</h3>
                            <form action="./addbank.php" method="POST">

                            
                                        <div class="row g-3">
                                            <div class="col-2"></div>
                                            <div class="col-4">
                                                <span>เลือกธนาคาร</span>
                                                <select class="form-control" name="Bank_Name" id="Bank_Name">
                                                    <option value="กรุงเทพ">กรุงเทพ</option>
                                                    <option value="กรุงไทย">กรุงไทย</option>
                                                    <option value="กสิกร">กสิกร</option>
                                                    <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <span>ชื่อบัญชี</span>
                                                <input type="text" id="Bank_Owner" name="Bank_Owner" class="form-control" required>
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-2"></div>
                                            <div class="col-3">
                                                <span>เลขที่บัญชี</span>
                                                <input class="form-control" id="Bank_Num" name="Bank_Num" required></input>
                                            </div>
                                            <div class="col-3">
                                                <span>สาขา</span>
                                                <input type="text" id="Bank_Branch" name="Bank_Branch" class="form-control" required>
                                            </div>
                                            <div class="col-2">
                                                <span>ประเภท</span>
                                                <select class="form-control" name="Bank_Type" id="Bank_Type">
                                                    <option value="ออมทรัพย์">ออมทรัพย์</option>
                                                    <option value="ฝากประจำ">ฝากประจำ</option>
                                                    <option value="ฝากไม่ประจำ">ฝากไม่ประจำ</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mt-5">                        
                                                <center>
                                                <input name="addbank" class="btn btn-success" type="submit" value="เพิ่มธนาคาร">
                                                <input name="removebank" class="btn btn-danger" type="submit" value="ลบข้อมูล">
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>

                    
                </div>
            </div>
        </div>


    </section>
    
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>