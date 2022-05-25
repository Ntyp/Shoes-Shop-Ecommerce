<?php
    include_once 'database.php';
    session_start();
    // echo '<pre>';
    // print_r($_SESSION);
    // echo'</pre>';
    $order_id = $_GET['order_id'];

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("Location: login.php");
    }
      //connect db
    $sql = "SELECT * FROM stock"; //เรียกข้อมูลมาแสดงทั้งหมด
    $result = mysqli_query($conn, $sql);
    $sql1 = "SELECT * FROM bank";
    $result1 = $conn->query($sql1);
    $cost = 50;
    $sql2 = "SELECT * FROM order_head WHERE order_id = $order_id";
    $result2 = $conn->query($sql2);
    $row2 = mysqli_fetch_array($result2);


    if(isset($_POST['btnpay'])) {
        $order_total = $_POST['order_total'];
        $bank_tranfer = $_POST['bank_tranfer'];
        $bank_img = $_POST['bank_img'];
        $payment_owner = $_SESSION['Username'];
        $date = date('Y-m-d',strtotime($_POST['bank_date']));
        $sqlpay = "INSERT INTO payment_order (payment_id,payment_owner,order_id,payment_total,payment_bank,payment_date,payment_img) VALUES(null,'$payment_owner','$order_id',' $order_total','$bank_tranfer','$date','$bank_img')";
        $resultpay = $conn->query($sqlpay);
        $update = "UPDATE order_head SET order_status = 'รอตรวจสอบ' WHERE order_id = $order_id;";
        $resultupdate = $conn->query($update);
        echo '<script>alert("กรุณารอแอดมินตรวจสอบการชำระเงินประมาณ 5-10 นาที");location.href="order.php";</script>';
        
    }
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
            <?php 
                if(!empty($_SESSION['Username'])){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="./contract.php">ติดต่อเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./cart.php">ตะกร้าสินค้า</a>
            </li>
            <?php
                }
            ?>
        </ul>

        <div class="d-flex">

        
            <!-- Dropdown  -->
            <?php if(!empty($_SESSION['Username'])){ ?>
            <li class="nav-item dropdown ">
                <a  style="text-decoration:none;color:white" class="nav-link btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                ยินดีต้อนรับคุณ
                    
                    <?php 
                        if(!empty($_SESSION['Username'])){
                            echo $_SESSION['Username'];
                        }
                        else {
                                
                        }
                    ?>
                    </a>
                <!-- เพิ่ม Session ชื่อผู้ใช้งาน -->
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a style="color:black" class="dropdown-item" href="edit_profile.php">แก้ไขข้อมูลส่วนตัว</a></li>
                    <li><a style="color:black" class="dropdown-item" href="order.php">สถานะคำสั่งซื้อ</a></li>
                    <li><a style="color:black" class="dropdown-item" href="https://th.kerryexpress.com/th/track/">เช็คพัสดุ</a></li>
                    <li><a href="index.php?logout='1'" style="color: red;" class="dropdown-item">ออกจากระบบ</a></li>
                </ul>
            </li>

            <?php } ?>
            <!-- End Dropdown  -->

            <!-- Start Login  -->
            <?php if(empty($_SESSION['Username'])){ ?>
                <div class="btn-cart">
                <!-- <button class="btn btn-success" type="submit"><a href="./login.php">เข้าสู่ระบบ</a></button> -->
                <button type="button" class="btn  btn-success mx-auto " data-bs-toggle="modal" data-bs-target="#modalLoginForm">
                เข้าสู่ระบบ
                </button>
                <!-- Modal Login -->
                <!-- modalLoginForm -->
                <div class="modal fade" id="modalLoginForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="loginform.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้งาน</label>
                                        <input type="text" class="form-control" id="User_Username" name="User_Username" placeholder="ชื่อผู้ใช้งาน" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="User_Password" name="User_Password" placeholder="รหัสผ่าน" />
                                    </div>
                                    <div class="modal-footer d-block">
                                        <p class="float-start">ยังไม่ได้เป็นสมาชิก ? <a href="" data-bs-toggle="modal"  data-bs-target="#modalRegisterForm">สมัครสมาชิก</a></p>
                                        <button type="submit" class="btn btn-success float-end">ยืนยัน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Modal Register -->
                <div class="modal fade" id="modalRegisterForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <form action="./registerform.php" method="POST">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <span>ชื่อผู้ใช้งาน</span><span style="color:red;">*</span>
                                                <input type="text" id="User_Username" name="User_Username" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>รหัสผ่าน</span><span style="color:red;">*</span>
                                                <input type="password" id="Password" name="Password" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>ชื่อ</span><span style="color:red;">*</span>
                                                <input type="text" id="Firstname" name="Firstname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>นามสกุล</span><span style="color:red;">*</span>
                                                <input type="text" id="Lastname" name="Lastname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>อีเมล์</span><span style="color:red;">*</span>
                                                <input type="email" id="Email" name="Email" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>เบอร์ติดต่อ</span><span style="color:red;">*</span>
                                                <input type="tel" id="Phone" name="Phone" class="form-control" required>
                                            </div>
                                            <div class="col-12">
                                                <span>ที่อยู่</span><span style="color:red;">*</span>
                                                <textarea class="form-control" id="Address" name="Address" placeholder="ที่อยู่" required></textarea>
                                            </div>
                                            <div class="col-6">
                                                <span>ตำบล</span><span style="color:red;">*</span>
                                                <input type="text" id="Tambon" name="Tambon" class="form-control" required>
                                            </div>
                                            <div class="col-6">
                                                <span>อำเภอ</span><span style="color:red;">*</span>
                                                <input type="text" id="Amphoe" name="Amphoe" class="form-control" required>
                                            </div>
                                            <div class="col-6">
                                                <span>จังหวัด</span><span style="color:red;">*</span>
                                                <input type="text" id="Province" name="Province" class="form-control" required>
                                            </div>
                                            <div class="col-6">
                                                <span>รหัสไปรษณี</span><span style="color:red;">*</span>
                                                <input type="text" id="Zipcode" name="Zipcode" class="form-control" required>
                                            </div>
                                            <div class="col-12 mt-5">                        
                                                <button type="submit" class="btn btn-success float-end">สมัครสมาชิก</button>
                                                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary float-end me-2 ">ยกเลิก</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <!-- Emd Login  -->
        </div>

        </div>
    </div>
    </nav>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <p>รายการสินค้า</p>
                <table class="table table-bordered">
                    <tr>
                        <td align='center'>รายการสินค้า</td>
                        <td align='center'>ราคา</td>
                    </tr>
                    <!-- <tr>
                        <th></th>
                        <td></td>
                    </tr> -->
                    <tr>
                        <th>ค่าจัดส่งสินค้า</th>
                        <td align='right'><?php echo $cost?> บาท</td>
                        <input type="hidden" value="50">
                    </tr>
                    <tr>
                        <th>ราคารวมทั้งสิ้น</th>
                        <td align='right'><?php echo $row2['order_total']; ?> บาท</td>
                    </tr>
                </table>
            </div>
        </div>
       <div class="row">
       <?php
            while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
        ?>
            <div class="col-md-3">
                <div class="card" style="width: 15rem;" >
                    <img src="img/<?php echo $row['Bank_Name'] ?>.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><b><?php echo $row['Bank_Name'] ?></b></h5>
                        <p><?php echo $row['Bank_Owner'] ?></p>
                        <span><?php echo $row['Bank_Num'] ?></span>
                        <span><?php echo $row['Bank_Branch'] ?></span>
                        <p><?php echo $row['Bank_Type'] ?></p>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
       </div>
        <div class="row">
            <div class="col">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <br><p>จำนวนเงิน</p>
                            <input name="order_total" id="order_total" value="<?php echo $row2['order_total']; ?>" class="form-control" type="number">
                        </div>
                        <div class="col">
                            <br><p>ธนาคารที่โอนมา</p>
                            
                            <select class="form-control" name="bank_tranfer" id="bank_tranfer">
                                <option value="กรุงเทพ">กรุงเทพ</option>
                                <option value="กรุงไทย">กรุงไทย</option>
                                <option value="กสิกร">กสิกร</option>
                                <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
                            </select> <br>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>วันที่โอน</p>
                            <input class="form-control" name="bank_date" id="bank_date" type="date"> <br>
                        </div>
                        <div class="col">
                            <p>อัพโหลดภาพสลิป</p>
                            <input class="form-control" name="bank_img" id="bank_img" type="file"> <br>
                        </div>
                        <!-- <div class="col">
                            <p>วันที่โอน</p>
                            <input class="form-control" name="bank_date" id="bank_date" type="date"> <br>
                        </div> -->
                    </div>
                    <input class="btn btn-success" name="btnpay" id="btnpay" type="submit" value="ยืนยันการชำระเงิน">
                </form>
            </div>
            
                
        </div>
            <br>
            
        </div>
    </div>
    </section>



    
    <footer>

    </footer>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>