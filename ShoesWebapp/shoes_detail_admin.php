<?php
    include_once 'database.php';
    session_start();

    
    $Code = $_GET['Code'];
    $sql = "SELECT * FROM stock WHERE Code = '$Code' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
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
                    <li><a class="dropdown-item" href="./stock.php">คลังสินค้า</a></li>
                    <li><a class="dropdown-item" href="./update_status.php">คำสั่งซื้อ</a></li>
                    <li><a class="dropdown-item" href="./coupon.php">คูปองส่วนลด</a></li>
                    <li><a class="dropdown-item" href="./coupon.php">สินค้าใกล้หมด</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    จัดการ
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">จัดการหมวดหมู่</a></li>
                    <li><a class="dropdown-item" href="./mangeitem.php">จัดการสินค้า</a></li>
                    <li><a class="dropdown-item" href="#">จัดการบัญชีการโอน</a></li>
                    <li><a class="dropdown-item" href="./mangeuser.php">เปลี่ยนระดับผู้ใช้งาน</a></li>
                    <li><a class="dropdown-item" href="./report_admin.php">รายงาน</a></li>
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
                <h3>อัปเดตสินค้า</h3>
                <div class="col-md-8">
                    <center><img style="width:50%;" src="./img/<?php echo $row["Img"];?>" alt=""> </center>
                </div>
                <div class="col-md-4">
                    <form action="update_product_admin.php?Code=<?php echo $row['Code'];?>&act=update" method="POST">
                        <h3><?php echo $row["Name"]; ?></h3>
                        <h3><b>ราคา</b> ฿<?php echo $row["Forsell"]; ?></h3>
                        <hr>
                        <input type="hidden" name="Code" value="<?php echo $row["Code"]; ?>"> 
                        <input type="hidden" class="form-control" name="Name" value="<?php echo $row["Name"]; ?>"> <br>
                        <div class="Price">
                        <div class="row">
                        <input type="hidden" class="form-control" name="Price" value="<?php echo $row["Forsell"]; ?>">
                        </div>
                        </div>
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
                                    <div class="cartbtn">
                                        <input type="submit" value="อัปเดตสินค้า">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
                        
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h3>รายละเอียดสินค้า</h3>
                    <?php echo $row["Detail"]; ?>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>

<?php
    }
?>