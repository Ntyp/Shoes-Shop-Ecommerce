<?php
    include_once './database.php';
    session_start();
    //     echo '<pre>';
    // print_r($_SESSION);
    // echo'</pre>';
    error_reporting(0);
    $Code = $_GET['Code'];
     $act = $_GET['act']; //การกระทำต่อสินค้า
     $Code2 = $_POST['Code']; //รหัสสินค้า
     $Name = $_POST['Name'];
     $Size = $_POST['Size'];//ไซต์
     $Color = $_POST['Color'];//สี
     $Forsell = $_POST['Forsell'];
     $Quatity = $_POST['Quatity']; //จำนวน

    //  if(isset($_POST['btnsearch'])) {
    //     $search = "SELECT * FROM stock_product WHERE Code = '$Code2' AND Color = '$Color' AND Size = '$Size'";
    //     $resultsearch = mysqli_query($conn,$search);
    //     $rowsearch = mysqli_fetch_array($resultsearch);
    // }
    $search = "SELECT * FROM stock_product WHERE Code = '$Code' ORDER BY Size";
    $resultsearch = mysqli_query($conn,$search);

    
    if(isset($_POST['addcart'])) {
        if($act=='add' && !empty($Code))
        {
            if(!empty($Quatity))
            {
                // IF SIZE && COLOR  QUATITY = 0 
                
                    $_SESSION['cart'][$_POST['product_ID']]['Code'] = $Code2;
                    $_SESSION['cart'][$_POST['product_ID']]['Name'] = $Name;
                    $_SESSION['cart'][$_POST['product_ID']]['Size'] = $Size;
                    $_SESSION['cart'][$_POST['product_ID']]['Color'] = $Color;
                    $_SESSION['cart'][$_POST['product_ID']]['Forsell'] = $Forsell;
                    $_SESSION['cart'][$_POST['product_ID']]['qty'] += $Quatity;

                    
                    // SEARH QUATITY
                    $checknum = "SELECT * FROM stock_product WHERE Code = '$Code2' && Size ='$Size' && Color = '$Color'";
                    $resultcheck = mysqli_query($conn,$checknum);
                    $rowcheck = mysqli_fetch_array($resultcheck);
                    if(!empty($rowcheck["Quatity"])){
                        echo '<script>alert("เพิ่มสินค้าใส่ตะกร้าสำเร็จ");</script>';
                    }
                    else {
                        unset($_SESSION['cart'][$_POST['product_ID']]);
                        echo '<script>alert("สินค้าหมด");</script>';
                    }
                

                
            }
            
        }
    }
        
     
        
     
     

    // $sql = "SELECT * FROM stock WHERE Code = $Code";
    $sql = "SELECT * FROM stock WHERE Code = '$Code' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    


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
                <div class="col-md-8">
                    <center><img style="width:50%;" src="./img/<?php echo $row["Img"];?>" alt=""> </center>
                </div>
                <div class="col-md-4">
                    <form action="shoes_detail.php?Code=<?php echo $row['Code'];?>&act=add" method="POST">
                        <h3><?php echo $row["Name"]; ?></h3>
                        <h3><b>ราคา</b> <?php echo $row["Forsell"]; ?> บาท</h3>
                        <hr>
                        <input type="hidden" name="product_ID" value="<?php echo $row["product_ID"]; ?>">
                        <input type="hidden" name="Code" value="<?php echo $row["Code"]; ?>">
                        <input type="hidden" name="Name" value="<?php echo $row["Name"]; ?>">
                        <input type="hidden" name="Forsell" value="<?php echo $row["Forsell"]; ?>">
                        <div class="Size">
                                <p>ไซต์</p>
                                <div class="row">
                                    <select class="form-control" name="Size" id="Size">
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                    </select>
                                </div>
                        </div>
                        <div class="Color">
                                <p>สี</p>
                                <div class="row">
                                    <select class="form-control" name="Color" id="Color">
                                        <option value="ดำ">ดำ</option>
                                        <option value="แดง">แดง</option>
                                        <option value="เทา">เทา</option>
                                        <option value="ฟ้า">ฟ้า</option>
                                    </select>
                                </div>
                        </div>
                        
                        <!-- <p>มีสินค้าทั้งหมด <?php echo $row['Quatity'] ?> ชิ้น</p> -->

                        <?php 
                            if(!empty($_SESSION['Username'])){
                        ?>
                        <div class="count">
                            <br>
                            <span>จำนวน</span>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="input-count">
                                        <input name="Quatity" id="Quatity" value="1" type="text">
                                    </div>
                                </div>
                                
                                <div class="col-md-10">
                                    <input style="margin-left: 10px;" class="btn btn-dark mt-1" name="addcart" id="addcart" type="submit" value="เพิ่มลงตะกร้า">
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                    </form>
                        
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <br>
                        <h3>รายละเอียดสินค้า</h3>
                        <?php echo $row["Detail"]; ?>
                </div>
            </div>
            <div style="margin-top:50px" class="row">
                <div class="col-md-12">
                <h3>จำนวนสินค้าคงเหลือ</h3>
                    <center>
                    
                    <table class="table table-bordered">
                        <tr>
                            <td align='center'>ไซต์</td>
                            <td align='center'>สี</td>
                            <td align='center'>จำนวน</td>
                        </tr>
                        <?php 
                            while($rowsearch = mysqli_fetch_array($resultsearch, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <td align='right'><?php echo $rowsearch['Size'] ?></td>
                            <td align='left'><?php echo $rowsearch['Color'] ?></td>
                            <td align='right'><?php echo $rowsearch['Quatity'] ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <footer>

    </footer>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>