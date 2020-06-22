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
		<link rel="stylesheet" href="../public/css/menustyle.css">

		<link rel="stylesheet" href="../../public/css/stylechitiet.css"><!-- Tiên 20/06 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- Tiên 20/06 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><!-- Tiên 20/06 -->

<!--		<script src="../ckeditor/ckeditor.js"></script>-->
<!--		<script src="../ckfinder/ckfinder.js"></script>-->
		<script src="../ckeditor/ckeditor.js"></script>
<!--		<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>-->
		<style>
			.btn-success{
				color:aliceblue;
				background-color: #5cb85c;
				border-color: #4cae4c;
			}
			.btn-primary {
				color: #fff;
				background-color: #337ab7;
				border-color: #2e6da4;
			}
			.btn {
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
			}
				span.text-alert {
				color: #1000ff;
				font-size: 20px;
				width: 100%;
				text-align: center;
				font-weight: bold;
}
		</style>
<!--
		<script type='text/javascript'>
            window.parent.CKEDITOR.tools.callFunction(
                {!! $CKEditorFuncNum !!},
                '{!! $data['url'] !!}',
                '{!! $data['message'] !!}'
            );
        </script>
-->		
	
		
		
	
	</head>
	<body style="background: #c2ddfc; padding: 0px; margin: 0px;">
		<div id="header">
			<div id="webname">
				<div style="font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                <div id="header_icon">
                     <div id="home" >
                     	<a href="../logout.php" onclick="return confirmAction()">
                     		<img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát">
                     	</a>
                     </div>
                     <div id="logout" style="margin-top:3px; padding:0; ">
                        	<a href="quanly.php">
                        		<img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ">
                        	</a>
                     </div>
                    <div id="name">
                    	<strong style="color: #e0f74f">
                    		<?php echo $name.'  ('. $Mnv.')' ?>
                    			
                    	</strong>
                    </div>               
                </div>
			</div>


		</div>

        <div id="content1" style="background-color: aliceblue; margin: 40px; border-radius: 15px; border: 1px solid #c9c9c9;">

        	<!-- Start Thêm  thanh điều hướng_Tiên_20/06 -->
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol style="background-color:  aliceblue;" class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/quanly.php"><i class="fa fa-home"></i>  Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/themfaq.php">Thêm FAQ</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->
             <br><br>
		 	<!-- <div id="menu">
                <ul>
                  <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="../Quanly/duyetfaq/duyetfaq.php"><b style="color:#fbf424;">Cập nhật FAQ</b></a></li>
                </ul>
            </div> -->
             <form action="xulyfaq.php" enctype="multipart/form-data" method="post">

				<div style="text-align: center" >
					<h2>Thêm FAQ</h2>
				</div><!--Tiên_20/06 -->
				
					<?php
                            if(isset($_SESSION['them'])){
                                echo '<span class="text-alert">'.$_SESSION['them'].'</span>';
                                unset($_SESSION['them']);
                            }
                            ?>
        	    <table align="center" width="100%" height="413">
        		
 
        			<tr>
        				
        				<td><label for="sel2">&emsp;Tiêu đề</label></td>
        				<td > <textarea style="width: 300px; height: 40px" name="tieude" placeholder="Nhập tiêu đề sự cố thường gặp" required></textarea></br></td>
        			</tr>
<!--
        			<tr>
        				<td width ="10%" height="49">Biện pháp hỗ trợ</td>
        				<td > <textarea name="bienphaphotro" style="width: 300px; height: 40px" placeholder="Nhập biện pháp hỗ trợ" required></textarea></br></td>
        
        			</tr>
-->
        			<tr>
        				<td><label for="sel2">&emsp;Giải quyết</label></td>
        				
						<td><textarea name="post_content" id="editor1" ></textarea></td>
						<script>
						var url = 'http://localhost/helpdesk';
							// Thay thế <textarea id="editor1"> với CKEditor
							CKEDITOR.replace( 'editor1',{
								uiColor: '#9AB8F3',
								filebrowserBrowseUrl: url+'/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: url+'/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							
								
							} );// tham số là biến name của textarea
						</script>
			

<!--        				<td><input type="file" name="avatar"/></br></td>-->
        			</tr>
					<tr>	
						<td height="61"></td>
						<td style="">
						    <input type="submit" class="btn btn-success" width="90px" height="30px" name="btnregister" value="Thêm">
							<input type="reset" class="btn btn-primary" width="90px" height="30px" name="btnreset" value="Làm mới">
						</td>
					</tr>
        	    </table>
            </form>
        </div>

		  <?php include 'footer.php';?>
		  <!-- Tiên 22/06 -->
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn đăng xuất?")
            }
    

        </SCRIPT>
	</body>
</html>