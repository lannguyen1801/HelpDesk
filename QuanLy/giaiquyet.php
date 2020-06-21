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
	$trangthai = 0;
	
	$con = new mysqli("localhost","root","","helpdesk1");
	mysqli_set_charset($con, 'UTF8');
if(isset($_GET["id"])){
    $idsc=$_GET["id"];

	$sqluser1="SELECT * FROM suco WHERE idsuco=$idsc";
	$kq1=$con->query($sqluser1);
	$row1= $kq1->fetch_assoc();
	$idsuco=$row1['idsuco'];
	$motasuco=$row1['motasuco'];
	$bienphap=$row1['bienphaphotro'];
}
if(isset($_GET["id"])){
	$idfaq=$_GET["id"];
	$sqluser2="SELECT * FROM faq where idfaq=$idfaq";
	$kq2=$con->query($sqluser2);
	$row2=$kq2->fetch_assoc();
	$idfaq1=$row2['idfaq'];
	
}
	$sqluser="SELECT * FROM faq";
	$queryuser=mysqli_query($con,$sqluser);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hệ thống quản lý sự cố Helpdesk</title>
        
<!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
-->
		<link rel="stylesheet" href="../public/css/stylePanel.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">    
		<link rel="stylesheet" href="../public/css/stylechitiet.css">
		<script src="../ckeditor/ckeditor.js"></script>
		
		
    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;">
        <div class="Container">
            <div class="row">
                <div id="header">
                    <div id="webname">
						<div style="color: aqua; font-size: 40px">Hệ thống quản lý sự cố Helpdesk</div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin:0px; padding:0; ">
                                <a href="quanly.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="content">
            <div id="menu">
                <ul>
                    <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="themsuco.php">Thêm mới</a></li>
                </ul>
            </div>
            <div style="text-align: center">
                <h2>Danh sách sự cố</h2>
            </div>
	<form>
	  <div class="form-group">
		<label for="exampleFormControlInput1">ID sự cố<br></label>
		<input type="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $idsuco;?>" readonly><br>
	  </div>
		<div class="form-group">
		<label for="exampleFormControlInput1">Mô tả sự cố<br></label>
		<input type="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $motasuco;?>" readonly><br>
	  </div>
		<div class="form-group">
<!--
		<label for="exampleFormControlInput1">Biện pháp hỗ trợ<br></label>
		<input type="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $bienphap;?>" readonly><br>
-->
	  </div>
<!--
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		  <label class="form-check-label" for="inlineRadio1">Sự cố có trong câu hỏi FAQ</label>
		</div>
-->
<!--
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
		  <label class="form-check-label" for="inlineRadio2">Thêm một sự cố</label>
		</div>
-->
		<div id="content1" >
				<select multiple onchange="validateSelectBox(this)">
						<?php  while ($userList=mysqli_fetch_array($queryuser)){
							echo '<option value="'.$userList["idfaq"].'">'.$userList["idfaq"].'__'.$userList["tieude"].'</option>'.'<br>';
								}
						
					
					?>
				</select>

						<h3>Danh sách chuyên mục bạn đã chọn:</h3>
		<script language="javascript">
            function validateSelectBox(obj){
                var options = obj.children;
                var html = '';
				var id = '';
                for (var i = 0; i < options.length; i++){
                    if (options[i].selected){
                        html += '<li>'+options[i].value+'</li>';
						id +=options[i].value;
                    }
                }
                
//                document.getElementById('result').innerHTML = html;
				document.getElementById("result1").value = id;
            }
        </script>

				<div id="result">
							Bạn chưa chọn chuyên mục nào
				</div>
			<div>
				<input type="text" id="result1" name="tensuco" width="200px" placeholder="Nhập tên sự cố" required />
			</div>
		</div>
		<div id="content2" style="display: none">
			<textarea name="tieude" width="200px" placeholder="Nhập tiêu đề" required></textarea><br>
			<textarea name="giaiquyet" width="200px" placeholder="Nhập biện pháp giải quyết" required></textarea><br>
		</div>
		
		<div id="">
			<input type="submit" class="btn btn-success" name="btnsubmit" value="Gui">
			<input type="reset" class="btn btn-primary" name="btnreset" value="Dat lai">
		</div>
		<div id="php">
			<?php
				$sql2 = "UPDATE suco SET bosung=$idfaq1 WHERE idsuco = $idsuco";
				$con->query($sql2);
				$con->close();
			?>
		</div>
<!--
        <script language="javascript">

            document.getElementById("inlineRadio1").onclick = function () {
                document.getElementById("content1").style.display = 'block';
				document.getElementById("content2").style.display = 'none';
				
				
            };

            document.getElementById("inlineRadio2").onclick = function () {
                document.getElementById("content1").style.display = 'none';
				document.getElementById("content2").style.display = 'block';
				document.getElementById("demo").innerHTML = "Hello World";
            };

        </script>
-->
	</form>
        </div>
        <link rel="stylesheet" type="text/css" href="../public/DataTables/datatables.min.css" />
        <script src="../public/jQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../public/DataTables/datatables.min.js">
        </script>
        <div id="footer" style="text-align: center">
            <p>Khoa Công nghệ thông tin - Đại học Cần Thơ</p>
        </div>
    </body>

    </html>
