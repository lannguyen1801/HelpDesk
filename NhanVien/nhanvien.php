<?php
    session_start();
//	if (isset($_SESSION['idtaikhoan'])) {
//		$taikhoan = $_SESSION['idtaikhoan'];
//	  }
   // include ('../db/pgiangvien.php');
    $id=$_SESSION['idtaikhoan'];
    require ('../conn.php');
//    $sql="SELECT taikhoan.*, donvi.TENDV from canbo, donvi 
//        WHERE canbo.MADV=donvi.MADV AND canbo.MACB='$id';";
 $sql="SELECT taikhoan.*, nhomnguoidung.ten from taikhoan, nhomnguoidung 
        WHERE taikhoan.IDnhomnguoidung=nhomnguoidung.idnhomnguoidung AND taikhoan.idtaikhoan='$id';";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    $Mnv=$row['idtaikhoan'];
    $name=$row['taikhoan'];
    $ns=$row['matkhau'];
    $email=$row['email'];
    $chucvu=$row['ten'];
//    $tendv=$row['TENDV'];
?>
<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<head>
        <title>Hệ thống quản lý sự cố helpdesk</title>
		<link rel="stylesheet" href="../public/css/stylePanel.css">
	</head>
	<body style="background: #c2ddfc; padding: 0px; margin: 0px;">
	
		<div id="header">
			<div id="webname">
				<div style="color: aqua; font-size: 40px;width: 800px;float: left;">Hệ thống quản lý sự cố Helpdesk</div>
                <div id="header_icon">
                     <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                        <div id="logout" style="margin:0px; padding:0; "><a href="nhanvien.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>                </div>
			</div>


		</div>

        <div id="content">
            <div id="information"><h2 style="text-align: center; color: #ed1e1e">Thông tin nhân viên</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px;margin-bottom:10px; border-style: dotted; border-width: 1px;">Mã nhân viên</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $Mnv ;?></b></div></td>
                    </tr>
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px;margin-bottom:10px; border-style: dotted; border-width: 1px;">Họ tên</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $name?></b></div></td>
                    </tr>
<!--
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Ngày sinh</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $ns ?></b></div></td>
                    </tr>
-->
<!--
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #c9c9c9;height: 30px; line-height: 30px; padding-left:5px">Đơn vị</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $tendv ?></b></div></td>
                    </tr>
-->
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px; margin-bottom:10px; border-style: dotted; border-width: 1px;">Chức vụ</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $chucvu?></b></div></td>
                    </tr>
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px; margin-bottom:10px; border-style: dotted; border-width: 1px;">Email</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $email?></b></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="function">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr style="padding: 5px">
                        <td style="padding-top: 5px">
                            <?php
                            $thang=date('m');
                            $nam=date('Y');
                            echo '<div class="itemFuntion"><a href="xemsuco/xemsuco1.php"><img src="../public/img/nhanvienlogin/danhsach.jpg" height="67px" width="67px" alt=""></a></div>';
                            ?>

                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><a href="doimatkhau.php"><img src="../public/img/reset.png" height="67px" width="67px" alt=""></a></div>-->
							 <div class="itemFuntion"><a href="themsuco/themsuco.php"><img src="../public/img/nhanvienlogin/them.jpg" height="67px" width="67px" alt=""></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 5px">
                            <div class="itemFuntion"><b>Danh sách sự cố</b></div><!-- Tiên 20/06 -->
                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><b>Đổi mật khẩu</b></div>-->
							<div class="itemFuntion"><b>Thêm sự cố</b></div>
                        </td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><a href="themsuco/themsuco.php"><img src="../public/img/nhanvienlogin/sign-question-icon.png" height="67px" width="67px" alt=""></div>-->
                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><img src="../public/img/nhanvienlogin/sign-question-icon.png" height="67px" width="67px" alt=""></div>-->
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 5px">
                            
                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><b>Chức năng đang phát triển</b></div>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

		<?php include 'footer.php';?>

		


</html>