<?php

if(isset($_POST["submit"])){
    require ('conn.php');
    session_start();
    $username = $_POST["username"];
    $pass= $_POST["password"];
    $username = strip_tags($username);
    $username = addslashes($username);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);
    $passE=($pass);
    $sql="SELECT * FROM taikhoan WHERE
        taikhoan ='$username' AND
        matkhau= '$passE'";
//    echo $sql;
//    echo '</br>';
    $query = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
//    echo $num_rows; echo '</br>';
//    echo $pass;
    if ($num_rows==0){
        echo '<script type="text/javascript">alert("Tài khoản hoặc mật khẩu đã bị sai");</script>';
    } else
    if($row['TRANGTHAI']==1){

       header('Location: Errorpage.php');
    }
    else{
        $id=$row['idtaikhoan'];
        $level=$row['IDnhomnguoidung'];
       // $smdv="SELECT `MADV` FROM `canbo` WHERE `MACB` = '$id';";
       // $mdvquery = mysqli_query($conn,$smdv);
        //$rowmdv = mysqli_fetch_assoc($mdvquery);
        $_SESSION['username']=$username;
        $_SESSION['idtaikhoan'] =$id;
        $_SESSION['IDnhomnguoidung'] =$level;
       // $_SESSION['DonVi']=$rowmdv['MADV'];
        $sqlnumberUrl="SELECT Url FROM nhomnguoidung WHERE idnhomnguoidung =$level";
        $numberUrlResult=mysqli_query($conn,$sqlnumberUrl);
        $url=mysqli_fetch_assoc($numberUrlResult);
        $link=$url["Url"];
        header('Location:'.$link);
    }
		
}
		$con = new mysqli("localhost","root","","helpdesk1");
		$sqluser="SELECT * FROM faq";
    	$queryuser=mysqli_query($con,$sqluser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/styleLogin.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
	<style>
		#dangnhap{
			width: 400px;
		}
	</style>
</head>
<body>
<div id="google_translate_element"></div> 
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<table id="table">
		<tr>
			<td colspan="3"><h1 class="welcome text-center">HỆ THỐNG QUẢN LÝ SỰ CỐ HELPDESK</h1></td>
		</tr>
		<tr >
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr height="200px">
			<td width="5%"></td>
			<td width="35%" style="vertical-align: top;">		 
				<div id = "dangnhap" width="200px">
				<br>
				<h3  style="color: darkgreen; text-align: center">Đăng nhập</h3>
				<hr>
					<form class="form-signin" action="index.php" method="POST">
						<span id="reauth-email" class="reauth-email"></span>
						<input type="text" name="username" id="inputEmail" class="form-control" placeholder="Tài khoản" required autofocus>
						<br>
						<input type="password" name="password" id="inputPassword" class="login_box" placeholder="Mật khẩu" required>
						<button class="btn btn-lg btn-primary" name="submit" type="submit">Đăng nhập</button>
					</form>
				</div>
			</td>
			<td style="font-size: 12px; margin-top: 0px;vertical-align: top;" rowspan="2">
					<p style="font-size: 30px;color: chocolate; text-align: center;">Các sự cố thường gặp	</p>
								<?php
									$connect = mysqli_connect('localhost','root','','helpdesk1');
									mysqli_set_charset($connect,"utf8");
								?>
								<?php
									$page=1;//khởi tạo trang ban đầu
									$limit=4;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
									$arrs_list = mysqli_query($connect,"
										select idfaq from faq
									");
									$total_record = mysqli_num_rows($arrs_list);//tính tổng số bản ghi có trong bảng khoahoc
									$total_page=ceil($total_record/$limit);//tính tổng số trang sẽ chia
									//xem trang có vượt giới hạn không:
									if(isset($_GET["page"]))
										$page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
									if($page<1) $page=1; //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
									if($page>$total_page) $page=$total_page;//nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng
									//tính start (vị trí bản ghi sẽ bắt đầu lấy):
									$start=($page-1)*$limit;
									//lấy ra danh sách và gán vào biến $arrs:
									$arrs = mysqli_query($connect,"
										select * from faq limit $start,$limit");
								?>
									
										<?php foreach($arrs as $arr){ ?>
											<table style="margin: 10px; padding-left: 20px">
												<tr>
													<td style="font-size: 20px; color: red;"><?php echo $arr["idfaq"]; ?>&nbsp;</td>
													<td style="font-size: 20px; color: inherit"><?php echo $arr["tieude"]; ?></td>
												</tr>
												<tr>
													<td colspan="2"><?php echo $arr["giaiquyet"]; ?></td>
												</tr>
											</table>
										<?php } ?>
				
			</td>
		</tr>
		<tr height="150px">
			<td colspan="2"></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<nav aria-label="...">
				  <ul class="pagination">
					
					<?php for($i=1;$i<=$total_page;$i++){ ?>
								<li <?php if($page == $i) echo "class='page-item'"; ?> ><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php } ?>
	
				  </ul>
				</nav>
			</td>
		</tr>
	</table>
 <div class="container">
   
	 
		   
		</div>
<!--	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--	<link rel="stylesheet" href="css/giaodien.css">-->
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</body>
</html>
