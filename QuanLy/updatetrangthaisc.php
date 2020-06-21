<?php
//insert.php  
$connect = mysqli_connect("localhost", "root", "", "helpdesk1");

//	$congviec=$_POST['congviec'];
//	$congviec=$_POST['nguoigiaiquyet'];
//	$thoigian=$_POST['thoigian'];
	
if(!empty($_POST))
{
 $output = '';
 	$name = mysqli_real_escape_string($connect, $_POST["id"]);  
//    $address = mysqli_real_escape_string($connect, $_POST["valgq"]);  
//    $gender = mysqli_real_escape_string($connect, $_POST["nguoigiaiquyet"]);  
//    $designation = mysqli_real_escape_string($connect, $_POST["trangthai"]);  
//    $age = mysqli_real_escape_string($connect, $_POST["thoigian"]);

	$query = "update suco set trangthaiduyet=1 where idsuco = '$name'";
	
	if($connect->query($query)==true){
		echo "update thành công";
	}else {
		echo "Update thất bại: " .$connect->error;
	}
	
	$connect->close();

}
else {
	echo "<p align=\"center\">Cap nhat That bai</p>";
}

?>
