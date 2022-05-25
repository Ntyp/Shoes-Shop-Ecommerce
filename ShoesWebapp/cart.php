<?php
    include_once 'database.php';
    session_start();


    // echo '<pre>';
    // print_r($_SESSION);
    // echo'</pre>';
    error_reporting(0);
     $act = $_GET['act']; //การกระทำต่อสินค้า
     $Code = $_POST['Code']; //รหัสสินค้า
     $Name = $_POST['Name'];
     $Size = $_POST['Size'];//ไซต์
     $Color = $_POST['Color'];//สี
     $Quatity = $_POST['Quatity']; //จำนวน
     $choose_add = $_POST['choose_add'];
     echo $choose_add;
     $Cost = 50;
     $product_ID = 1;

     
     echo $_SESSION['cart']['product_ID'];
     if($act =='remove')  
     {
         unset($_SESSION['cart'][$product_ID]);
     }

     if($act == 'cancel') {
         unset($_SESSION['cart']);
     }
     if(isset($_POST['btn_Coupon'])) {
         $sqlCoupon = "SELECT * FROM coupon WHERE $Coupon_Code = $Coupon";
         $resultCoupon = mysqli_query($conn,$sqlCoupon);
     }

     if(!$_SESSION['Status'] == "User") {
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
                    <li><a style="color:black" class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a></li>
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
                                                <span>จังหวัด</span><span style="color:red;">*</span>
                                                <!-- <input type="text" id="Province" name="Province" class="form-control" required> -->
                                                <select class="form-control" name="Ref_prov_id" id="provinces">
                                                    <option  value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                                    <?php foreach ($query_provinces as $value) { ?>
                                                        <!-- // ผลลัพธ์ออกมาเป็นตัวเลข -->
                                                        <option value="<?=$value['id']?>"><?=$value['name_th']?></option>
                                                        <!-- <input type="hidden" name="Ref_prov_id_1" value="'.$value['name_th'].'" > -->
                                                    <?php } ?>
                                                </select>
                                                
                                            </div>
                                            <div class="col-6">
                                                <span>อำเภอ</span><span style="color:red;">*</span>
                                                <!-- <input type="text" id="Amphoe" name="Amphoe" class="form-control" required> -->
                                                <select class="form-control" name="Ref_dist_id" id="amphures">
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <span>ตำบล</span><span style="color:red;">*</span>
                                                <!-- <input type="text" id="Tambon" name="Tambon" class="form-control" required> -->
                                                <select class="form-control" name="Ref_subdist_id" id="districts">
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <span>รหัสไปรษณี</span><span style="color:red;">*</span>
                                                <input type="text" id="zip_code" name="zip_code" class="form-control" required>
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
                <!-- End Login  -->
        </div>

        </div>
    </div>
    </nav>

    <section>
    <div class="container">
        <div class="row">
        <form id="frmcart" name="frmcart" method="POST" action="confirm.php">
            <table width="600" border="0" align="center" class="square table table-bordered">
                <h3>ตะกร้าสินค้า</h3>
                <tr>
                    <td align="center" bgcolor="#EAEAEA">รายการที่</td>
                    <td align="center" bgcolor="#EAEAEA">รหัสสินค้า</td>
                    <td align="center" bgcolor="#EAEAEA">ชื่อสินค้า</td>
                    <td align="center" bgcolor="#EAEAEA">ไซต์</td>
                    <td align="center" bgcolor="#EAEAEA">สี</td>
                    <td align="center" bgcolor="#EAEAEA">ราคาต่อคู่(บาท)</td>
                    <td align="center" bgcolor="#EAEAEA">จำนวน(คู่)</td>
                    <td align="center" bgcolor="#EAEAEA">ราคารวม</td>
                    <td align="center" bgcolor="#EAEAEA">ยกเลิก</td>
                </tr>
                <?php
                $total=0;
                if(!empty($_SESSION['cart']))
                {
                    foreach($_SESSION['cart'] as $Code=>$qty)
                    {
                        $sql = "SELECT * FROM stock_product  WHERE Code= '$Code'";
                        $query = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($query);           
                        $sum = $_SESSION['cart'][$Code]['Forsell']*$_SESSION['cart'][$Code]['qty']  ;
                        $total += $sum;
                        
                        echo "<tr>";
                        echo "<td align='center'>".$product_ID++ ."</td>"; //ลำดับสินค้า
                        echo "<td align='left'>" . $_SESSION['cart'][$Code]['Code'] . "</td>"; //รหัสสินค้า
                        echo "<td align='left'>" . $_SESSION['cart'][$Code]['Name'] . "</td>"; //สินค้า
                        echo "<td align='right'>" . $_SESSION['cart'][$Code]['Size'] . "</td>"; //ไซต์
                        echo "<td align='center'>" . $_SESSION['cart'][$Code]['Color'] . "</td>"; //สี
                        echo "<td align='right'>" . $_SESSION['cart'][$Code]['Forsell'] . "</td>"; //ราคา
                        echo "<td align='right'>" . $_SESSION['cart'][$Code]['qty'] . "</td>"; //จำนวน
                        echo "<td align='right'>" . $sum . "</td>"; //รวม(บาท)
                        echo "<td align='center'><a href='cart.php?Code=$Code&act=remove'>ลบ</a></td>"; //ลบ

                        
                        //รวม
                        //remove product
                        //<input type="hidden" name="product_ID" value="<?php echo $row["product_ID"];
                        
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td colspan='4' bgcolor='#CEE7FF' align='center'><b>ค่าจัดส่งสินค้า</b></td>";
                    echo "<td align='right' colspan='5'><b>$Cost.00 </b></td>";
                    echo "</tr>";

                    $total1 = $total+$Cost;
                    echo "<tr>";
                    echo "<td colspan='4' bgcolor='#CEE7FF' align='center'><b>ราคารวม(บาท)</b></td>";
                    echo "<td colspan='5' align='right' bgcolor='#CEE7FF'>"."<b>".number_format($total1,2) ."</b>"."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div class="row mt-5">
            </div>
            <center>
            <input class="btn btn-danger" type="button" name="btncancel" value="ยกเลิกคำสั่งซื้อ" onclick="window.location='cart.php?act=cancel';" />
            <input class="btn btn-success" type="button" name="Submit2" value="สั่งซื้อ" onclick="window.location='confirm.php';" />
            </center>
        </form>
        </div>
    </div>
    </section>

    <footer>

    </footer>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>
<?php
    }
?>