<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);

    $sql = "SELECT * FROM stock";
    $result = $conn->query($sql);

    


    $product_ID = $_POST['product_ID'];
    $product_Size = $_POST['product_Size'];
    $product_Color = $_POST['product_Color'];
    $product_Quatity = $_POST['product_Quatity'];
    
    

    $sql2 = "SELECT Name,Forsell FROM stock WHERE Code = '$product_ID'";
    $result2 = $conn->query($sql2);
    $row2 = mysqli_fetch_array($result2);
    $product_Name = $row2['Name'];
    $product_Sell = $row2['Forsell'];

    if(isset($_POST['addbtn'])) {
        // echo $product_ID;
        $sql1 = "INSERT INTO stock_product (Code,Name,Size,Color,Quatity,Forsell) 
        VALUES ('$product_ID','$product_Name','$product_Size','$product_Color','$product_Quatity','$product_Sell')";

        
        $result1 = $conn->query($sql1);
        echo '<script>alert("เพิ่มสินค้าสำเร็จ");location.href="mangeitem1.php";</script>';
    }
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
            <div class="col">
                <h3>เพิ่มสินค้าเข้าสต็อก</h3>
                <form action="" method="POST">
                        <div class="row">
                            <div class="col">
                            <br><p>รุ่น</p>
                                <select class="form-control" name="product_ID" id="product_ID">
                                    <?php
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    ?>
                                    <option value="<?php echo $row['Code']; ?>"><?php echo $row['Code']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col">
                            <br><p>ไซต์</p>
                                <select class="form-control" name="product_Size" id="product_Size">
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <br><p>สี</p>
                                <select class="form-control" name="product_Color" id="product_Color">
                                        <option value="ดำ">ดำ</option>
                                        <option value="แดง">แดง</option>
                                        <option value="เทา">เทา</option>
                                        <option value="ฟ้า">ฟ้า</option>
                                </select>       
                            </div>
                            <div class="col">
                            <br><p>จำนวน</p>
                                <input class="form-control" type="text" name="product_Quatity" id="product_Quatity" required>
                            </div>
                        </div>
                        <br>
                        <input  class="btn btn-success float-end" name="addbtn" id="addbtn" type="submit" value="+ เพิ่มสินค้าเข้าสต็อก">
                       
                       
                       
                        
                    
                    
                     
                </form>
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