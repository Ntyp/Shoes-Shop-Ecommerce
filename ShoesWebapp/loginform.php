<?php
    include_once 'database.php';
    session_start();

    $User_Username = $_POST['User_Username'];
    $User_Password = $_POST['User_Password'];

    $sql = "SELECT * FROM user WHERE User_Username = '$User_Username' AND User_Password = '$User_Password'";
    $result = mysqli_query($conn,$sql);


    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['Username'] = $row['User_Username'];
        $_SESSION['Status'] = $row['User_Status'];

        if($_SESSION['Status'] == 'Admin') {
            echo '<script>alert("เข้าสู่ระบบสำเร็จ");location.href="admin.php";</script>';
        }
        if($_SESSION['Status'] == 'User') {
            echo '<script>alert("เข้าสู่ระบบสำเร็จ");location.href="index.php";</script>';
        }
        else {
            echo "Error";
        }
    }
    else {
        echo '<script>alert("เข้าสู่ระบบผิดพลาดกรุณาลองใหม่อีกครั้ง");location.href="index.php";</script>';
    }
?>