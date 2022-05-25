<?php
include_once 'database.php';
session_start();
     $User_Username = $_POST['User_Username'];
	  $Password = $_POST['Password'];
	  $Firstname = $_POST['Firstname'];
	  $Lastname = $_POST['Lastname']; 
      $Email = $_POST['Email'];
	  $Phone = $_POST['Phone'];
      $Address = $_POST['Address'];
    // จังหวัด
    $Province = $_POST['Ref_prov_id'];
	$sql_province = "SELECT * FROM provinces WHERE id = '$Province'";
	$result_province = mysqli_query($conn,$sql_province);
	$row_province = mysqli_fetch_array($result_province);
	$Province1 = $row_province['name_th'];
    // อำเภอ
    $Amphoe = $_POST['Ref_dist_id'];
	$sql_amphoe = "SELECT * FROM amphures WHERE id = '$Amphoe'";
	$result_amphoe = mysqli_query($conn,$sql_amphoe);
	$row_amphoe = mysqli_fetch_array($result_amphoe);
	$Amphoe1 = $row_amphoe['name_th'];
    // ตำบล
    $Tambon = $_POST['Ref_subdist_id'];
	$sql_tambon = "SELECT * FROM districts WHERE id = '$Tambon'";
	$result_tambon = mysqli_query($conn,$sql_tambon);
	$row_tambon = mysqli_fetch_array($result_tambon);
	$Tambon1 = $row_tambon['name_th'];


	  $Zipcode = $_POST['zip_code'];
      $Status = "User";
	 $sql = "INSERT INTO user (User_Username,User_Password,User_Firstname,User_Lastname,User_Email,User_Phone,User_Address,User_Tambon,User_Amphoe,User_Province,User_Zipcode,User_Status)
	 VALUES ('$User_Username','$Password','$Firstname','$Lastname','$Email','$Phone','$Address','$Tambon1','$Amphoe1','$Province1','$Zipcode','$Status')";
	 $result = mysqli_query($conn,$sql);
	 $_SESSION['User_Username'] = $User_Username;

	 if($result) {
		 echo '<script>alert("สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ");location.href="index.php";</script>';
	 }
	 else {
		 echo '<script>alert("มีบางอย่างผิดพลาด กรุณาลองอีกครั้ง");location.href="index.php";</script>';
	 }
	//  if (mysqli_query($conn, $sql)) {
	// 	$_SESSION['Username'] = $Username;
	// 	header("Location: index.php");
	//  } 
    //  else{
    //      echo "ERROR";
    //  }
	 mysqli_close($conn);
?>