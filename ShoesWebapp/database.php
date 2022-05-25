<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoes_shop";

// Create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);
mysqli_query($conn,"SET CHARACTER SET UTF8");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected Successfully.";
?>