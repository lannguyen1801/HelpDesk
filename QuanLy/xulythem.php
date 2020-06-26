<?php
	$con = new mysqli("localhost","root","","helpdesk1");
	mysqli_set_charset($con, 'UTF8');
    session_start();
    if(isset($_SESSION['idtaikhoan'])){
        $taikhoan=$_SESSION['idtaikhoan'];
    }
    else{
        header("location:../../index.php");
    }
    $sql = "select * from taikhoan where taikhoan='$taikhoan'";
    $kq=$con->query($sql);
    $row= $kq->fetch_assoc();
//    $idtv=$row['id'];
	$tensuco=$_POST['tensuco'];
	$mucdo=0;
	$motasuco=$_POST['motasuco'];
//	$bienphap=$_POST['bienphaphotro'];
	$hinhanhsc= $_POST["post_content"];
	$sophong=$_POST['sophong'];
	$somay=$_POST['somay'];
	$thietbihong=$_POST['thietbihong'];
	$sodienthoai=$_POST["sodt"];
//	$hinhanhsc="./img/".$_FILES['avatar']['name'];
////	$giasp=$_POST['giasp'];
//	move_uploaded_file($_FILES['avatar']['tmp_name'], $hinhanhsc);

//	$sql = "INSERT INTO suco(tensuco,motasuco,bienphaphotro,hinhanhsc,thoigianyeucau) VALUES ('','$tensuco','$motasuco',$bienphap,'$hinhanhsc',NOW(),'','1')";

$sql = "INSERT INTO `suco` (`idsuco`, `tensuco`, `motasuco`, `hinhanh`,`sophong`, `somay`,`thietbihong`,`mucdo`, `thoigianyeucau`, `thoigianhoanthanh`, `trangthaiduyet`,`sdtlienlac`) VALUES ('', '$tensuco', '$motasuco', '$hinhanhsc','$sophong','$somay','$thietbihong','$mucdo', NOW(), '', '','$sodienthoai')";
	if($con->query($sql)==true){
		$_SESSION['them']='Thêm  sự cố thành công';
		echo "<script language='javascript'>
											
										
											 window.location='themsuco.php';
				</script>";
}else {
	$_SESSION['them']='Thêm sự cố không thành công';
		echo "<script language='javascript'>
											
											 window.location='themsuco.php';
				</script>";
	}

	$con->close();

?>