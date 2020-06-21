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
    $address = mysqli_real_escape_string($connect, $_POST["congviec"]);  
    $gender = mysqli_real_escape_string($connect, $_POST["nguoigiaiquyet"]);  
    $mucdo=mysqli_real_escape_string($connect, $_POST["mucdohu"]); 
//    $designation = mysqli_real_escape_string($connect, $_POST["trangthai"]);  
    $age = mysqli_real_escape_string($connect, $_POST["thoigian"]);
    $query = "
   INSERT INTO `giaiquyet` (`idgq`, `id`, `congviec`, `nguoigiaiquyet`, `trangthai`, `thoigian`) VALUES (NULL, '$name', '$address', '$gender', '0', '$age')";

   $nvsql="UPDATE `suco` SET
        `mucdo`='$mucdo' WHERE idsuco = '$name' ";

	if(($connect->query($query)==true)&&($connect->query($nvsql)==true)) {
		echo "<script language='javascript'>
				alert('Thao tác thành công');
			</script>"; 
		$queryupdate = "update suco set trangthaiduyet=2 , thoigianhoanthanh='$age' where $name=idsuco";
		if($connect->query($queryupdate)==true){
			echo "<script language='javascript'>
				alert('update thành công');
			</script>";
		}else {
			echo "<script language='javascript'>
				alert('update that bai');
			</script>";
		}
	}
//	$connect->query($query);
//
//	$connect->close();
//	echo "<p align=\"center\">THÊM SỰ CỐ THÀNH CÔNG</p>";
//    if(mysqli_query($connect, $query))
//    {
//     $output .= '<label class="text-success">Data Inserted</label>';
//     $select_query = "SELECT * FROM giaiquyet ORDER BY id DESC";
//     $result = mysqli_query($connect, $select_query);
//     $output .= '
//      <table class="table table-bordered">  
//                    <tr>  
//                         <th width="70%">Employee Name</th>  
//                         <th width="30%">View</th>  
//                    </tr>
//
//     ';
//     while($row = mysqli_fetch_array($result))
//     {
//      $output .= '
//       <tr>  
//                         <td>' . $row["id"] . '</td>  
//                         <td><input type="button" name="view" value="view" id="' . $row["idgq"] . '" class="btn btn-info btn-xs view_data" /></td>  
//                    </tr>
//      ';
//     }
//     $output .= '</table>';
//    }
//    echo $output;
}
else {
	echo "<p align=\"center\">THÊM SỰ CỐ That bai</p>";
}
	$connect->close();
?>
