<?php
include_once './database.php';
session_start();
$Username = $_POST['Username'];
$Status = $_POST['Status'];
$sql = "UPDATE user SET User_Status = '$Status' WHERE User_Username = '$Username' ";
if ($conn->query($sql) === TRUE) {
    echo '<script>alert("อัปเดตสำเร็จ");location.href="mangeuser.php";</script>';
}
else {
    echo '<script>alert("อัปเดตผิดพลาดกรุณาลองอีกครั้ง");location.href="mangeuser.php";</script>';
}
?>