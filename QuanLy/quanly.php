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
<!--		<link rel="stylesheet" href="../public/css/menustyle.css">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--        <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">    -->
<!--		<link rel="stylesheet" href="../public/css/stylechitiet.css">-->
	</head>
	<body style="background: #c2ddfc; padding: 0px; margin: 0px;">
		<div id="header">
            
			<div id="webname">
				<div style="margin-top:10px;font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                <div id="header_icon" style="margin-top:10px;">
                     <div id="home" >
                        <a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 5px" alt="Thoát"></a>
                    </div>

                    <div id="logout" style="margin-top:5px padding:0; ">
                        <a href="quanly.php">
                            <img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ">
                        </a>
                    </div>
                    
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong>
                    </div>                
                </div>
			</div>


		</div>

        <div id="content">
            <div id="information"><h2 style="text-align: center; color: #ed1e1e">Thông tin Quản lý</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr style="border-style: dotted; border-width: 2px;">
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px;margin-bottom:10px; border-style: dotted; border-width: 1px; ">Mã nhân viên</div></td>
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
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px;margin-bottom:10px;border-style: dotted; border-width: 1px;">Chức vụ</div></td>
                        <td><div style="padding-left: 10px; color: #4286f4"><b><?php echo $chucvu?></b></div></td>
                    </tr>
                    <tr >
                        <td style="text-align: left" width="24%"><div style="background-color: #f1eaea;height: 30px; line-height: 30px; padding-left:5px;margin-bottom:10px;border-style: dotted; border-width: 1px;">Email</div></td>
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
                            echo '<div class="itemFuntion"><a href="duyetsuco/duyetsuco.php"><img src="../public/img/nhanvienlogin/danhsach.jpg" height="67px" width="67px" alt=""></a></div>';
                            ?>

                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><a href="doimatkhau.php"><img src="../public/img/reset.png" height="67px" width="67px" alt=""></a></div>-->
							 <div class="itemFuntion"><a href="themsuco.php"><img src="../public/img/nhanvienlogin/them.jpg" height="67px" width="67px" alt=""></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 5px">
                            <div class="itemFuntion"><b>Danh sách sự cố</b></div>
                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><b>Đổi mật khẩu</b></div>-->
							 <div class="itemFuntion"><b>Thêm sự cố</b></div>
                        </td>
                    </tr>
					
					<tr style="padding: 5px">
                        <td style="padding-top: 40px">
                            <?php
                            $thang=date('m');
                            $nam=date('Y');
                            echo '<div class="itemFuntion"><a href="duyetfaq/duyetfaq.php"><img src="../public/img/nhanvienlogin/update_faq.jpg" height="67px" width="67px" alt=""></a></div>';
                            ?>

                        </td>
                        <td style="padding-top: 40px">
<!--                            <div class="itemFuntion"><a href="doimatkhau.php"><img src="../public/img/reset.png" height="67px" width="67px" alt=""></a></div>-->
							 <div class="itemFuntion"><a href="themfaq.php"><img src="../public/img/nhanvienlogin/add_faq.gif" height="67px" width="67px" alt=""></div>
                        </td>
                    </tr>
					<tr>
                        <td style="padding-top: 5px">
                            <div class="itemFuntion"><b> Danh sách câu hỏi (FAQ)</b></div>
                            <!--Tiên_20/06 -->
                        </td>
                        <td style="padding-top: 5px">
<!--                            <div class="itemFuntion"><b>Đổi mật khẩu</b></div>-->
							 <div class="itemFuntion"><b>Thêm FAQ</b></div>
                        </td>
                    </tr>
                    <tr style="padding: 5px">
                        <td style="padding-top: 5px">
                           
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
	</body>
</html>