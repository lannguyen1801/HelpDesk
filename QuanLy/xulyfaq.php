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
	//$tensuco=$_POST['tensuco'];
	
	$tieude=$_POST['tieude'];
//	$bienphap=$_POST['bienphaphotro'];
	$giaiquyet= $_POST["post_content"];
	//$sophong=$_POST['sophong'];
	//$somay=$_POST['somay'];
//	$hinhanhsc="./img/".$_FILES['avatar']['name'];
////	$giasp=$_POST['giasp'];
//	move_uploaded_file($_FILES['avatar']['tmp_name'], $hinhanhsc);

//	$sql = "INSERT INTO suco(tensuco,motasuco,bienphaphotro,hinhanhsc,thoigianyeucau) VALUES ('','$tensuco','$motasuco',$bienphap,'$hinhanhsc',NOW(),'','1')";
$sql = "INSERT INTO `faq` (`idfaq`, `tieude`, `giaiquyet`) VALUES ('', '$tieude', '$giaiquyet')";
	
	if($con->query($sql)==true){
		$_SESSION['them']='Thêm  FAQ thành công';
		echo "<script language='javascript'>
											
										
											 window.location='themfaq.php';
				</script>";
}else {
	$_SESSION['them']='Thêm FAQ không thành công';
		echo "<script language='javascript'>
											
											 window.location='themfaq.php';
				</script>";
	}

	$con->close();

?>