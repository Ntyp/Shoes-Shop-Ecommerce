<?php
    include_once 'database.php';
    session_start();
    error_reporting(0);

    $order_id = $_GET['order_id'];
    $searchpost = "SELECT * FROM postcode_detail WHERE order_id = '$order_id'";
    $resultpost = mysqli_query($conn,$searchpost);
    $rowpost = mysqli_fetch_array($resultpost);

    $searchdate = "SELECT * FROM payment_order WHERE order_id = '$order_id'";
    $resultdate = mysqli_query($conn,$searchdate);
    $rowdate = mysqli_fetch_array($resultdate);

    require_once __DIR__ . '/vendor/autoload.php';


    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf',
        ]
    ],
    'default_font' => 'sarabun'
]);
    // Open Buffer
    ob_start();

    // require_once __DIR__ . '/vendor/autoload.php';

    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
    $order_id = $_GET['order_id'];
    $count = 1;
    $cost = 50;
    $sumtotal = 0;
    $discount = 0;
    // สิ่งของที่สั่ง
    $sql = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
    $result = mysqli_query($conn,$sql);

    // รายละเอียดคำสั่งซื้อ ชื่อ ที่อยู่ เมล์
    $sql1 = "SELECT * FROM order_head WHERE order_id = '$order_id'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Shoes Cafe | ใบเสร็จรับเงิน</title>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3><b>ใบสั่งซื้อสินค้า</b></h3>
                    <p>คำสั่งซื้อที่: <?php echo $order_id; ?></p>
                    <div class="row">
                        <div class="col">
                            <p><b>ไอดีที่สั่งสินค้า: </b><?php echo $row1['order_owner']; ?></p>
                            <p><b>ชื่อผู้รับ: </b><?php echo $row1['order_name']; ?></p>
                            <p><b>เบอร์ติดต่อ: </b><?php echo $row1['order_phone']; ?></p>
                            <p><b>เลขที่พัสดุจัดส่งสินค้า: </b><?php echo $rowpost['postcode_code'] ?></p>
                        </div>
                        <div class="col">
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h3>ร้าน Shoes Cafe</h3>
                    <p><b>ที่อยู่ร้าน:</b> 112/1 หมู่4 ต.กลอนโด อ.ด่านมะขามเตี้ย<br> จ.กาญจนบุรี 71260</p>
                    <p><b>ที่อยู่: </b><?php echo $row1['order_address']; ?></p>
                    <p><b>อีเมล์: </b><?php echo $row1['order_email']; ?></p>
                    <p><b>วันที่: </b><?php echo $rowdate['payment_date']; ?></p> 
                </div>
                <table class="table table-bordered">
                    <tr style="border:1px solid #000">
                        <td   align='center'><b>ลำดับ</b></td>
                        <td   align='center'><b>รายการสินค้า</b></td>
                        <td align='center'><b>ราคาต่อคู่ (บาท)</b></td>
                        <td   align='center'><b>จำนวน (ชิ้น)</b></td>
                        <td   align='center'><b>ราคารวม (บาท)</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr style="border:1px solid #000">
                        <td style="border:1px solid #000" align='center' width:20px><?php echo $count++?></td>
                        <td style="border:1px solid #000" align='left'><?php echo $row['product_ID'];?></td>
                        <td style="border:1px solid #000" align='right'><?php echo $row['detail_subtotal'] / $row['detail_qty'];?></td>
                        <td style="border:1px solid #000" align='right'><?php echo $row['detail_qty'];?></td>
                        <td style="border:1px solid #000" align='right'><?php echo number_format($row['detail_subtotal'],2);?></td>
                        <?php $sumtotal += $row['detail_subtotal']?>
                    </tr>
                    <?php 
                        }
                    ?>
                    <tr style="border:1px solid #000">
                        <td style="border:1px solid #000" colspan='3'>ราคารวม </td>
                        <td style="border:1px solid #000" colspan='2' align='right'><?php echo number_format($sumtotal,2) ?></td>
                    </tr>
                    <tr style="border:1px solid #000">
                        <td style="border:1px solid #000" colspan='3'>ค่าจัดส่งสินค้า</td>
                        <td style="border:1px solid #000" colspan='2' align='right'><?php echo number_format($cost,2) ?></td>
                    </tr>
                    <?php $sumtotal += $cost+$discount ?>
                    <tr style="border:1px solid #000">
                        <td style="border:1px solid #000" colspan='3'>ราคารวมทั้งสิ้น </td>
                        <td style="border:1px solid #000" colspan='2' align='right'><?php echo number_format($sumtotal,2) ?></td>
                    </tr>
                </table>
                <p><b>รายละเอียดการรับประกันสินค้า</b></p>
                <p>1.หากสินค้าชำรุดและต้องการเครมสินค้ากรุณามาเครมก่อนออกจากร้าน</p>
                <!-- <a class="btn btn-primary" href="MyReport.pdf">พิมพ์ใบเสร็จ</a> -->
            </div>
        </div>
    </section>
</body>
<script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</html>
<?php
    $html=ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("MyReport.pdf");
    ob_end_flush();
?>