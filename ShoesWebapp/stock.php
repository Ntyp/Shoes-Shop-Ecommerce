<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);
    // โชว์ข้อมูลในตาราง
    $sql = "SELECT * FROM stock_product ORDER BY `Code` ASC ";
    $result = $conn->query($sql);


    $act = $_GET['act'];
    // เพิ่มสินค้า
    if(isset($_POST['btnupdaate'])) {
        $Code = $_POST['Code'];
        $Size = $_POST['Size'];
        $Color = $_POST['Color'];
        $Quatity = $_POST['Quatity'];
        $update = "UPDATE stock_product SET Quatity = Quatity+'$Quatity' WHERE Code = '$Code' AND Size = '$Size' AND Color = '$Color'";
        $resultupdate = mysqli_query($conn,$update);
        echo $update;
        echo '<script>alert("อัปเดตสินค้าสำเร็จ");location.href="stock.php";</script>';
    }
    // ลดสินค้า
    if(isset($_POST['btnminus'])) {
        $Code = $_POST['Code'];
        $Size = $_POST['Size'];
        $Color = $_POST['Color'];
        $Quatity = $_POST['Quatity'];
        $update = "UPDATE stock_product SET Quatity = Quatity-'$Quatity' WHERE Code = '$Code' AND Size = '$Size' AND Color = '$Color'";
        $resultupdate = mysqli_query($conn,$update);
        echo $update;
        echo '<script>alert("อัปเดตสินค้าสำเร็จ");location.href="stock.php";</script>';
    }
    
    // ลบข้อมูล
    // EDIT IF ITEM STATUS = 'ชำระเงินสำเร็จ' CAN'T DO IT!! 
    if($act == 'remove') {
        $Code = $_GET['Code'];
        $Size = $_GET['Size'];
        $Color = $_GET['Color'];
        // FIND STATUS BY ORDER_ID
        $search_product = "SELECT order_id FROM order_detail WHERE product_ID = '$Code' && detail_color = '$Color' && detail_size = '$Size'";
        echo $search_product;
        // ถ้ารหัสไม่มีก็จะให้ข้ามไปเลย
        $resultsearch = mysqli_query($conn,$search_product);
        if(empty($rowsearch_product_1 = mysqli_fetch_array($resultsearch))) {
            echo $rowsearch_product['order_id'];
                $remove = "DELETE FROM stock_product WHERE Code = '$Code' AND Size = '$Size' AND Color = '$Color'";
                $resultremove = mysqli_query($conn,$remove);
                echo '<script>alert("ลบสินค้าสำเร็จ");location.href="stock.php";</script>';
        }
        while($rowsearch_product = mysqli_fetch_array($resultsearch, MYSQLI_ASSOC)){
            echo "ออเดอร์".$rowsearch_product['order_id'];
            // ถ้ายังไม่มีใน orderid
            if(!empty($rowsearch_product['order_id'])) {
                echo $rowsearch_product['order_id'];
                // SEARCH ORDER_ID IF STATUS = 'ชำระเงินสำเร็จ'
                $check_status = "SELECT * FROM order_head WHERE order_status = 'ชำระเงินสำเร็จ'";
                $resultcheck_status = mysqli_query($conn,$check_status);
                $rowcheck_status = mysqli_fetch_array($resultcheck_status);
                
                if($rowcheck_status['order_status'] == 'ชำระเงินสำเร็จ') {
                    echo '<script>alert("ไม่สามารถลบได้เนื่องจากมีออเดอร์ตกค้าง");location.href="stock.php";</script>';
                    echo $rowcheck_status['order_status'];
                    break;
                }
                if($rowcheck_status['order_status'] != 'ชำระเงินสำเร็จ') {
                    $remove = "DELETE FROM stock_product WHERE Code = '$Code' AND Size = '$Size' AND Color = '$Color'";
                    $resultremove = mysqli_query($conn,$remove);
                    echo '<script>alert("ลบสินค้าสำเร็จ");location.href="stock.php";</script>';
                }
            }
            // บัคหาตัวที่ไม่มีลบไม่ได้
            else {
                $remove = "DELETE FROM stock_product WHERE Code = '$Code' AND Size = '$Size' AND Color = '$Color'";
                $resultremove = mysqli_query($conn,$remove);
                echo '<script>alert("ลบสินค้าสำเร็จ");location.href="stock.php";</script>';
            }
            

            
        }
        

        
    }
    // อัปเดตข้อมูล





    
    // if($act == 'update') {
    //     $Code = $_GET['Code'];
    //     $Size = $_GET['Size'];
    //     $Color = $_GET['Color'];
    //     $Quatity1 = $_POST['Quatity1'];
    //     echo 'จำนวน' . $Quatity1;

    //     // SQL ใช้ได้เหลือ GET ค่า Quatity
    
    //     $resultupdate = mysqli_query($conn,$update);
    //     // echo $resultupdate;
    //     // echo '<script>alert("อัปเดตสินค้าสำเร็จ");location.href="stock.php";</script>';
    // }
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
                <center>
                <h3>คลังสินค้า</h3>
                <form action="" method="POST">

                    <div class="row">   
                        <form action="" method="POST">
                                <div class="col-1">
                                    <span>กรุณาใส่รหัสสินค้า</span>
                                </div>
                                <div class="col-3">
                                    <input class="form-control"  id="Code" name="Code" type="text" placeholder="">
                                </div>
                                <div class="col-1">
                                    <select class="form-control" name="Size" id="Size">
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" name="Color" id="Color">
                                        <option value="ดำ">ดำ</option>
                                        <option value="แดง">แดง</option>
                                        <option value="เทา">เทา</option>
                                        <option value="ฟ้า">ฟ้า</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input class="form-control" id="Quatity" name="Quatity" type="text" placeholder="จำนวน">
                                </div>
                                <div class="col-2">
                                    <input class="btn btn-success" name="btnupdaate" id="btnupdate" type="submit" value="เพิ่มจำนวนสินค้า">
                                </div>
                                <div class="col-2">
                                    <input class="btn btn-danger" name="btnminus" id="btnminus" type="submit" value="ลดจำนวนสินค้า">
                                </div>
                        </form>
                    </div>
                 
                    
                    
                    <div class="table-responsive">
                        <table class="table table-bordered mt-4">
                            
                            <tr>
                                <td align="center"><b>รหัสสินค้า</b></td>
                                <td align="center"><b>ชื่อสินค้า</b></td>
                                <td align="center"><b>ไซต์</b></td>
                                <td align="center"><b>สี</b></td>
                                <td align="center"><b>จำนวน</b></td>
                                <td align="center"><b>ราคา</b></td>
                                <td align="center"><b>แอคชั่น</b></td>
                            </tr>

                            <?php
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            ?>

                            <tr>
                                <td align="left"><?php echo $row["Code"]?></td>
                                <td><?php echo $row["Name"]?></td>
                                <td align="right"><?php echo $row["Size"]?></td>
                                <td align="center"><?php echo $row["Color"]?></td>
                                <!-- <td align="right"><input  class="form-control" id="Quatity1" name="Quatity1" type="text" value="<?php echo $row["Quatity"]?>"></td> -->
                                <td align="right"><?php echo $row["Quatity"]?></td>
                                <td align="right"><?php echo $row["Forsell"]?></td>
                                <td align="center"><a class="btn btn-danger" href='stock.php?Code=<?php echo $row['Code']; ?>&Size=<?php echo $row['Size']; ?>&Color=<?php echo $row['Color']; ?>&act=remove'>ลบสินค้า</a></td>
                            </tr>
                                    
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </form>
                </center>
            </div>
        </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>

</html>