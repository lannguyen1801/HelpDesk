<?php
//insert.php  
$connect = mysqli_connect("localhost", "root", "", "helpdesk1");

//	$congviec=$_POST['congviec'];
//	$congviec=$_POST['nguoigiaiquyet'];
//	$thoigian=$_POST['thoigian'];
	
if(!empty($_POST))
{
 $output = '';
 	$name = mysqli_real_escape_string($connect, $_POST["idgq"]);  
    $address = mysqli_real_escape_string($connect, $_POST["valgq"]);  
	$namesuco = mysqli_real_escape_string($connect, $_POST["name"]);
//    $gender = mysqli_real_escape_string($connect, $_POST["nguoigiaiquyet"]);  
//    $designation = mysqli_real_escape_string($connect, $_POST["trangthai"]);  
//    $age = mysqli_real_escape_string($connect, $_POST["thoigian"]);
if($address=="Đang xử lý"){
	$query = "update giaiquyet set trangthai=1 where idgq = '$name'";
}else {
	$query = "update giaiquyet set trangthai=2 where idgq = '$name'";
	$queryedit = "select * from suco,giaiquyet where $namesuco=suco.idsuco and $namesuco=giaiquyet.id";
		$result = mysqli_query($connect,$queryedit);
//		$kq = $connect->query($queryedit);
//		$row = $kq->fetch_assoc();
//		$row2= $kq1->fetch_assoc();
		while($row = mysqli_fetch_array($result)){
//			echo $row['idgq'];
//			echo $row['trangthai'];
			if($row['trangthai']!=1&&$row['trangthai']!=2){
//				echo "that bai;";
				$check=0;
				break;
			}else 
//				echo "thanh cong";
				$check =1;
		}
//		echo $check;
		if($check==1){
			$queryupdate = "update suco set trangthaiduyet=3 where $namesuco = suco.idsuco";
			if($connect->query($queryupdate)==true){
				echo "Sự cố đã được hoàn thành</br>";
			}
//			else {
//				echo "that bai:!!!!";
//			}
		}
}
	
	if($connect->query($query)==true){
		echo "Update thành công";
	}else {
		echo "Update thất bại: " .$connect->error;
	}
	
	$connect->close();

}
else {
	echo "<p align=\"center\">Cap nhat That bai</p>";
}

?>
