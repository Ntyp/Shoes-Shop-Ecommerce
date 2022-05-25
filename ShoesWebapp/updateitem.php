<?php
    include_once 'database.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Por Shop</title>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <h3 style="text-align: center;">อัปเดตสินค้า</h3>
                                    <form action="./mangeitemform.php" method="POST">
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
                                                <input type="text" id="Forbuy" name="Forbuy" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <span>ราคาขาย</span>
                                                <input type="text" id="Forsell" name="Forsell" class="form-control" required>
                                            </div>
                                            <div class="col-md-12">
                                                <span>ประเภทสินค้า</span>
                                                <select name="Type" id="Type" class="form-control">
                                                    <option value="">กรุณาเลือกประเภท</option>
                                                    <option value="Men">รองเท้าผู้ชาย</option>
                                                    <option value="Women">รองเท้าผู้หญิง</option>
                                                    <option value="Kid">รองเท้าเด็ก</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <span>รายละเอียดสินค้า</span>
                                                <textarea class="form-control" id="Detail" name="Detail" required></textarea>
                                            </div>
                                            <div class="col-6">
                                                <span>จำนวนสินค้า</span>
                                                <input type="text" id="Quatity" name="Quatity" class="form-control" required>
                                            </div>
                                            <div class="col-6">
                                                <span>รูปภาพสินค้า</span>
                                                <input id="Img" name="Img" type="file">
                                            </div>
                                            <a href="admin.php">กลับสู่หน้าหลัก</a>
                                            <div class="col-12 mt-5">                        
                                                <button type="submit" class="btn btn-success float-end">+ เพิ่มสินค้า</button>
                                                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary float-end me-2 ">ยกเลิก</button>
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
</html>
