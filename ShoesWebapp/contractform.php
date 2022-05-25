<?php
    include_once 'database.php';
    session_start();
        $Report_Name = $_POST['Name'];
        $Report_Phone = $_POST['Phone'];
        $Report_Email = $_POST['Email'];
        $Report_Topic = $_POST['Topic'];
        $Report_Detail = $_POST['Detail'];

        $sql = "INSERT INTO report (Report_Name,Report_Phone,Report_Email,Report_Topic,Report_Detail)
        VALUE ('$Report_Name','$Report_Phone','$Report_Email','$Report_Topic','$Report_Detail')";
        $result = mysqli_query($conn,$sql);
        echo '<script>alert("ส่งข้อมูลสำเร็จ");location.href="contract.php";</script>';
        
        // if($result) {
            // echo "<script>alert(ส่งสำเร็จ);
            // window.location=contact.php;</script>";
        // }
        // else {
        //     echo "<script>alert(การส่งไม่สำเร็จกรุณาลองใหม่อีกครั้ง);
        //     window.location=contact.php;</script>";
        // }
?>