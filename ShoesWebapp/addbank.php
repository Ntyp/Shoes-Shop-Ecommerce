<?php
    include_once 'database.php';
    session_start();
    $Bank_Name = $_POST['Bank_Name'];
    $Bank_Owner = $_POST['Bank_Owner'];
    $Bank_Num = $_POST['Bank_Num'];
    $Bank_Branch = $_POST['Bank_Branch'];
    $Bank_Type = $_POST['Bank_Type'];
    if(isset($_POST['removebank'])) {
        $sql = "DELETE FROM bank WHERE Bank_Num = '$Bank_Num'";
        $result = $conn->query($sql);
        if($result) {
            header("Location:mange_bank.php");
        }
    }
    if(isset($_POST['addbank'])) {
        $sql = "INSERT INTO bank (Bank_Name,Bank_Owner,Bank_Num,Bank_Branch,Bank_Type)
        VALUE ('$Bank_Name','$Bank_Owner','$Bank_Num','$Bank_Branch','$Bank_Type')";
        $result = $conn->query($sql);
        if($result) {
            header("Location:mange_bank.php");
        }
    }
    
?>