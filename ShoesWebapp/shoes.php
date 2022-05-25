<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Por Shop</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Por Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="./men.php">ผู้ชาย</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./women.php">ผู้หญิง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./kid.php">เด็ก</a>
            </li>
        </ul>
        <form class="d-flex">
                <div class="btn-cart">
                    <button class="btn btn-success" type="submit"><a href="./checkpost.php">ตะกร้าสินค้า</a></button>
                </div>
        </form>
        </div>
    </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <center><img src="./img/sport/H0c7e97a28c4b42cd8c35b89cd8085ad7f.jpg_.webp" alt=""> </center>
                </div>
                <div class="col-md-4">
                    <h3>รองเท้าแตะผู้ชายหูหนีบ</h3>
                    <h3>THB 259</h3>
                    <hr>
                    <p>เลือกไซส์ที่มีในสต็อก</p>
                    <div class="size">
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn">39</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn">39.5</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn">40</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn">41</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn">42</button>
                            </div>
                        </div>
                    </div>
                    <div class="color">
                        <div class="row">
                            <div class="col select-col">
                            <p>เลือกสี</p>
                                <select class="select-color"  name="" id="">
                                    <option value="">สีดำ</option>
                                    <option value="">สีแดง</option>
                                    <option value="">สีเทา</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="count">
                        <p>จำนวน</p>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-count">
                                    <input name="count" type="text">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="cartbtn">
                                    <a href="./cart.php"><button>ใส่ตะกร้า</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>

    </footer>
</body>
</html>