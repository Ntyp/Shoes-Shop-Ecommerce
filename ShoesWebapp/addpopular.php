<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    $sql = "SELECT * FROM stock";
    $result = mysqli_query($conn,$sql);
    $popular_id = 1;

    // รับข้อมูลสำหรับเพิ่มเข้าสินค้ายอดนิยม


    // แอดข้อมูลเข้า stock_popular
    if(isset($_POST['btnadd'])) {
        $product_pop = $_POST['product_pop']; //รหัสที่แอดเข้ามา
        $showspop = "SELECT * FROM stock WHERE Code = '$product_pop'";
        $resultaddpop = mysqli_query($conn,$showspop);
        $rowaddpop = mysqli_fetch_array($resultaddpop);
        $product_ID = $rowaddpop['product_ID'];
        $Code = $rowaddpop['Code'];
        $Name = $rowaddpop['Name'];
        $Forsell = $rowaddpop['Forsell'];
        $Type = $rowaddpop['Type'];
        $Img = $rowaddpop['Img'];
        $addpop = "INSERT INTO stock_popular (popular_ID , product_ID , Code , Name , Forsell , Type , Img) VALUES (null,'$product_ID','$Code','$Name','$Forsell' , '$Type' ,'$Img') ";
        $resultadd = mysqli_query($conn,$addpop);
        echo '<script>alert("เพิ่มสินค้าสำเร็จ");location.href="addpopular.php";</script>';
    }

    // ลบสินค้าออกจาก popular
    // if(isset($_POST['btndelete'])) {
        // $Code = $_GET['Code'];
        // $codepop = $_POST['Code'];
        // echo $url;
        
        // $deleteCode = "DELETE FROM stock_popular WHERE Code = '$codepop'";
        // $resultdelete = mysqli_query($conn,$deleteCode);
        // echo '<script>alert("ลบสินค้าสำเร็จ");location.href="addpopular.php";</script>';
    // }

    $act = $_GET['act'];
    if($act == 'remove') {
        $Code = $_GET['Code'];
        $deleteCode = "DELETE FROM stock_popular WHERE Code = '$Code'";
        $resultdelete = mysqli_query($conn,$deleteCode);
        echo '<script>alert("ลบสินค้าสำเร็จ");location.href="addpopular.php";</script>';
    }





    // แสดงข้อมูลในสินค้าที่นิยม
    $popular = "SELECT * FROM stock_popular";
    $resultpopular = mysqli_query($conn,$popular);

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
                    <li><a style="color:black" class="dropdown-item" href="./addpopular.php">เพิ่มสินคายอดนิยม</a></li>
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
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h3 style="text-align:center"><b><u>เพิ่มสินค้ายอดนิยม</u></b></h3>
                        <form action="" method="POST">
                            <span class="mt-5">กรุณาเลือกสินค้า</span>
                            <div class="row mt-3">
                                <div class="col-8">
                                    <select class="form-control" name="product_pop" id="product_pop" method="POST">
                                        <?php
                                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        ?>
                                            <option class="form-control" value="<?php echo $row['Code'] ?>"><?php echo $row['Code'] . " " . $row['Name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input style="align:center" class="btn btn-success float-start" name="btnadd" id="btnadd" type="submit" value="+ เพิ่มสินค้า">
                                </div>
                                
                                
                            </div>
                            
                            <br>
                            <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td align='center'>ลำดับ</td>
                            <td align='center'>รหัสสินค้า</td>
                            <td align='center'>ชื่อสินค้า</td>
                            <td align='center'>ราคาสินค้า</td>
                            <td align='center'>แอคชั่น</td>
                        </tr>
                        <?php
                                while($rowpop = mysqli_fetch_array($resultpopular, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <td><?php echo $popular_id++?></td>
                            <td><?php echo $rowpop['Code']; ?></td>
                            <td><?php echo $rowpop['Name']; ?></td>
                            <td align='right'><?php echo $rowpop['Forsell']; ?></td>
                            <input type="hidden" name="codepop" id="codepop" value="<?php echo $rowpop['Code']; ?>">
                            <td align='center'><a href='addpopular.php?Code=<?php echo $rowpop['Code']; ?>&act=remove'>ลบรายการ</a></td>
                            <!-- <input type="hidden" name="codepop" id="codepop" value="">
                            <td><input name="btndelete" id="btndelete" type="submit" value="ลบข้อมูล"></td> -->
                            <!--  -->
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                            
                        </form>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </section>


</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>

<?php
    }
?>