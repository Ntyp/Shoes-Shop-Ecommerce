<?php
include_once './database.php';
session_start();
$Type = $_POST['Type'];
$sql = "SELECT * FROM stock";
if ($conn->query($sql) === TRUE) {
    header("Location: stock.php");
}
else {
    echo "Error";
}
?>