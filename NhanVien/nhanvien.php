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
        <script src="../ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="../../public/css/stylechitiet.css">
        <script type="text/javascript">
            function themsuco(){
                document.getElementById("content1").style.display="block";
                document.getElementById("ssthem").style.display="none";

            }
             function ktsomay(){
                var somay1=document.getElementById("txtsomay").value;
                if(somay1<=40){
                    document.getElementById("nhacLoiUn").innerHTML="Hợp lệ";
                }
                else{
                    document.getElementById("nhacLoiUn").innerHTML="Số máy phải nhỏ hơn 40";
                }
    }
        </script>
	</head>
	<body style="background: #c2ddfc; padding: 0px; margin: 0px;">
	
		<div id="header">
			<div id="webname">
				<div style="margin-top:10px;font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                <div id="header_icon">
                     <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                        <div id="logout" style="margin:0px; padding:0; "><a href="nhanvien.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
                    <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>                </div>
			</div>


		</div>
        <div style="text-align: center;color: red;font-weight: bold;display: block" id="ssthem">
         <?php
                            if(isset($_SESSION['them'])){
                                echo '<span class="text-alert">'.$_SESSION['them'].'</span>';
                                unset($_SESSION['them']);
                            }
                            ?>
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
							 <div class="itemFuntion"><a href="#" id="suco" onclick="themsuco()"><img src="../public/img/nhanvienlogin/them.jpg" height="67px" width="67px" alt=""></a></div>
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
        <div id="content1" style="background-color: aliceblue; margin: auto; border-radius: 15px; border: 1px solid #c9c9c9; width: 1000px; margin-top: 20px;display: none" >
            <form action="../Nhanvien/themsuco/xulythem.php" enctype="multipart/form-data" method="post">
            
                    
                    <div style="text-align: center" >
                        <h2>Thêm Sự Cố</h2>
                    </div><!--Tiên_20/06 -->

                <table align="center" width="100%" height="413">
              
                    <!-- <tr>
                        <td width ="10%" height="41">Tên sự cố</td>
                      <td width="90%"> <input type="text" style="width: 200px; height: 20px" name="tensuco" placeholder="Nhập tên sự cố" required /></br></td>
                    </tr> -->
                    <tr>
                        <td><label for="sel2">Tên sự cố</label></td>
                        <td>
                            <select  name="tensuco" class="form-control" id="tensuco" style="width:150px;">
                                  <option value="Phần mềm">Phần Mềm</option>
                                  <option value="Phần cứng">Phần Cứng</option>
                                </select>

                        </td>
                    </tr>
                    
                    <tr>
                        <td><label for="sel2">Mô tả sự cố</label></td>
                        <td > <textarea style="width: 300px; height: 40px" name="motasuco" placeholder="Nhập mô tả" required></textarea></br></td>
                    </tr>
<!--
                    <tr>
                        <td width ="10%" height="49">Biện pháp hỗ trợ</td>
                        <td > <textarea name="bienphaphotro" style="width: 300px; height: 40px" placeholder="Nhập biện pháp hỗ trợ" required></textarea></br></td>
        
                    </tr>
-->
                    <tr>
                        <td><label for="sel2">Thông tin thêm</label></td>
                        <td><textarea name="post_content" id="editor" ></textarea></td>
                        <script>
                        var url = 'http://localhost/helpdesk';
                            // Thay thế <textarea id="editor"> với CKEditor
                            CKEDITOR.replace( 'editor',{
                                uiColor: '#9AB8F3',
                                filebrowserBrowseUrl: url+'/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl: url+'/ckfinder/ckfinder.html?type=Images',
                                filebrowserUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                            
                                
                            } );// tham số là biến name của textarea
                            CKEDITOR.on('dialogDefinition', function (ev) {

                                   var dialogName = ev.data.name,
                                       dialogDefinition = ev.data.definition;

                                   if (dialogName == 'image') {
                                       var onOk = dialogDefinition.onOk;

                                       dialogDefinition.onOk = function (e) {
                                           var width = this.getContentElement('info', 'txtWidth');
                                           width.setValue('100');//Set Default Width

                                           var height = this.getContentElement('info', 'txtHeight');
                                           height.setValue('100');//Set Default height

                                           onOk && onOk.apply(this, e);
                                       };
                                   }
                            });
                        </script>
            

<!--                        <td><input type="file" name="avatar"/></br></td>-->
                    </tr>
                    <tr>
                      <td><label for="sel2">Phòng</label></td>
                        <td>
                            <select name="sophong" class="form-control" id="phong" style="width:150px;">
                        <?php
                        $sql='SELECT * FROM phongban';
                        $result=mysqli_query($conn,$sql);
                        while ($dscv=mysqli_fetch_array($result)){
                            if($dscv["ten"]==$ifcbCVCB){
                                echo '<option value="'.$dscv["ten"].'" selected>'.$dscv["ten"].'</option>';
                            } else {
                                echo '<option value="'.$dscv["ten"].'">'.$dscv["ten"].'</option>';
                            }
                        }

                        ?>
                    </select>
                        </td>
                    </tr>
                    <tr>
                      <td><label for="sel2">Thiết bị hỏng</label></td>
                        <td>
                            <select  name="thietbihong" class="form-control" id="thietbihong" style="width:150px;">
                                  <option value="0">Máy PC</option>
                                  <option value="1">Laptop</option>
                                  <option value="2">Máy tính bảng</option>
                                  <option value="2">Điện thoại</option>
                                  <option value="3">Máy in</option>
                                  <option value="4">Máy fax</option>
                                </select>

                        </td>
                    </tr>
                    
                    <tr>
                        <td><label for="sel2">Số máy</label></td>
                        <td width="90%"> 
                            <input type="text" style="width: 200px; height: 20px" name="somay" id="txtsomay" onkeyup="ktsomay()" placeholder="Nhập số máy" required />
                            </br> 
                            <div id="nhacLoiUn"></div>
                        </td>
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

		


</html>