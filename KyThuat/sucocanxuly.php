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
    $query1 = mysqli_query($conn,$sql);
    $row1 = mysqli_fetch_assoc($query1);
    $Mnv=$row1['idtaikhoan'];
    $name=$row1['taikhoan'];
    $ns=$row1['matkhau'];
    $email=$row1['email'];
    $chucvu=$row1['ten'];
//Truy xuất thông tin công việc
	$idsc=$_GET['id'];
	$query = "select * from suco,giaiquyet,taikhoan,trangthaicv where giaiquyet.id=suco.idsuco and suco.idsuco=$idsc and taikhoan.idtaikhoan=giaiquyet.nguoigiaiquyet and giaiquyet.trangthai=trangthaicv.id and taikhoan.idtaikhoan=$id ";
    $result = mysqli_query($conn,$query);
	$kq1=$conn->query($query);
	$row2= $kq1->fetch_assoc();
	$tensuco=$row2['tensuco'];
	$motasuco=$row2['motasuco'];
	
//	$trangthai=$row2['trangthaiduyet'];
//	$trangthaiduyet = $row2['trangthai'];
	$ngaytao=$row2['thoigianyeucau'];
	
//Truy xuất Ajax phân công người xử lý
	$sqluser="SELECT * FROM taikhoan where taikhoan.IDnhomnguoidung=20002";
	$queryuser=mysqli_query($conn,$sqluser);
	$querytrangthai = "select * from suco,trangthai where $idsc = suco.idsuco and suco.trangthaiduyet = trangthai.idtrangthai";
	$resulttrangthai = mysqli_query($conn,$querytrangthai);
	$kqtrangthai=$conn->query($querytrangthai);
	$rowtrangthai= $kqtrangthai->fetch_assoc();
	$trangthai=$rowtrangthai['trangthai'];
	$hinhanh=$rowtrangthai['hinhanh'];
	$sophong=$rowtrangthai['sophong'];
	$somay=$rowtrangthai['somay'];
	$thietbihong=$rowtrangthai['thietbihong'];
	$hoanthanh=$rowtrangthai['thoigianhoanthanh'];
	$mucdo=$rowtrangthai['mucdo'];//lan 20/06
	$tensuco1=$rowtrangthai['tensuco'];
	$motasuco1=$rowtrangthai['motasuco'];
	
//	$trangthai=$row2['trangthaiduyet'];
//	$trangthaiduyet = $row2['trangthai'];
	$ngaytao1=$rowtrangthai['thoigianyeucau'];
//	echo $trangthai;
$i=1;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hệ thống quản lý sự cố Helpdesk</title>
        
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
		
		<link rel="stylesheet" href="../public/css/stylePanel.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../public/css/stylechitiet.css">

		<link rel="stylesheet" href="../../public/css/stylechitiet.css"><!-- Tiên 20/06 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- Tiên 20/06 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><!-- Tiên 20/06 -->

    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;">
        <div class="Container">
            <div class="row">
                <div id="header">
                    <div id="webname">
						<div style="margin-top:8px;font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../logout.php" onclick="return confirmAction()"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" 			alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin-top:3px; padding:0; ">
                                <a href="kythuat.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" 				alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">

        	<!-- Start Thêm  thanh điều hướng_Tiên_20/06 -->
            <div class="col-lg-5">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol style="background: white" class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../KyThuat/kythuat.php"><i class="fa fa-home"></i>   Kỹ Thuật Viên</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../KyThuat/suco.php">Danh sách sự cố </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="">Xem chi tiết sự cố </a>
                        </li>
                    </ol>
                </nav>
            </div>
            <br><br>
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->

            <div id="menu">
                <ul>
                    <!-- <li><a href="../KyThuat/suco.php"><b style="color:#fbf424;">Sự cố cần xử lý</b></a></li> -->
                   
                </ul>
            </div>
			<div style="width:1000px; margin: auto;">
				<h3>Sự cố</h3>
					<table width="89%" height="50" class="table table-bordered" style="">
					<tr align="center"> 
						<th style="text-align: center;"width="5%">ID</th>
						<th style="text-align: center;"width="11%">Tên sự cố</th>
						<th style="text-align: center;"width="11%">Mô tả</th>
						<th style="text-align: center;"width="9%">Phòng</th>
						<th style="text-align: center;"width="5%">Số máy</th>
						<th style="text-align: center;"width="9%">Thông tin</th>
						<th style="text-align: center;"width="7%">Thiết bị hỏng</th>
						<th style="text-align: center;"width="3%">Mức độ</th> <!-- lan 20/06 -->
						<th style="text-align: center;"width="11%">Ngày tạo</th>
						<th style="text-align: center;"width="11%">Ngày dự kiến hoàn thành</th>
						<th style="text-align: center;"width="15%">Trạng thái</th>
					
					</tr>
					<tr align="center">
						<td><?php echo $idsc?></td>
						<td><?php echo $tensuco1?></td>
						<td><?php echo $motasuco1?></td>
						<td><?php echo $sophong?></td>
						<td><?php echo $somay?></td>
							<td><?php echo $hinhanh?></td>
							<?php	 if($thietbihong=="0")
					  echo  '<td >Máy PC</td>';
					elseif($thietbihong=="1")
					 echo  '<td >Laptop</td>';
					 elseif($thietbihong=="2")
					 echo  '<td >Máy tính bảng</td>';
					  elseif($thietbihong=="3")
					 echo  '<td >Điện thoại</td>';
					  elseif($thietbihong=="4")
					 echo  '<td >Máy in</td>';
					  elseif($thietbihong=="5")
					 echo  '<td >Máy fax</td>';

// lan 20/06
					if($mucdo=="0")
                      echo  '<td >//</td>';
                    elseif($mucdo=="1")
                     echo  '<td >Nhẹ</td>';
                    elseif($mucdo=="2")
                     echo  '<td >Trung bình</td>';
                     elseif($mucdo=="3")
                     echo  '<td >Nặng</td>';

					?>
					
						<td><?php echo $ngaytao1?></td>
						<td><?php echo $hoanthanh?></td>
						<td><?php echo $trangthai?></td>
						
					</tr>
				</table>
			</div>
			<form method="post">
				<div class="container" style="width:1000px;">  
				   <h3 align="center">Các công việc cần xử lý<br />  
				   </h3>
				   <div class="table-responsive">
					<div align="right">
<!--					 <button type="button" name="id" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Thêm công việc</button>-->
					</div>
					<br />
					<div id="employee_table">

			<table class="table table-bordered">
				<tr>
					<th width="5%">STT</th>
					<th width="26%">Công việc</th> 
					<th width="24%">Người xử lý</th>
					<th width="28%">Trạng thái</th>
					<th width="17%">Hiển thị chi tiết</th>
				</tr>
					  <?php
					  while($row = mysqli_fetch_array($result))
					  {
					  ?>
					  <tr>
						<td><?php echo $i++; ?></td>
					   <td><?php echo $row["congviec"]; ?></td>
						  <td><?php echo $row["taikhoan"]; ?></td>

						




						 <td><input type="button" name="<?php echo $idsc?>" value="<?php echo $row["trangthai"]; ?>" id="<?php echo $row["idgq"]; ?>" class="btn btn-info btn-xs view_data"/></td>
						   
					    <td><input type="button" name="view" value="Xem" id="<?php echo $row["idgq"]; ?>" class="btn btn-info btn-xs view_data" /></td>
					  </tr>
					  <?php
					  }
					  ?>
			</table>
					</div>
				   </div>  
				  </div>
			</form>
        </div>
      <?php include 'footer.php';?>
		<div id="chitietsp"></div>
		<div id="hienthihinhanh"></div>
		 <!-- Tiên 22/06 -->
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn đăng xuất?")
            }
    

        </SCRIPT>

    </body>
</html>


<!--Form insert cong viec of su co-->

<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Thêm công việc</h4>
   </div>	  
   <div class="modal-body">
    <form method="post" id="insert_form">
		
     <label>ID</label>
     <input type="text" name="id" id="name" class="form-control" value="<?php 
			echo $idsc; ?>"/>
     <br />
     <label>Xử lý công việc</label>
     <textarea name="congviec" id="address" class="form-control"></textarea>
     <br />
     <label>Phân công xử lý</label>
     <select name="nguoigiaiquyet" id="gender" class="form-control" onchange="validateSelectBox(this)">
		 <option value=""> -- Chọn -- </option>
      <?php  while ($userList=mysqli_fetch_array($queryuser)){
							echo '<option value="'.$userList["idtaikhoan"].'">'.$userList["idtaikhoan"].'__'.$userList["taikhoan"].'</option>'.'<br>';
								}
					?>
     </select>

						<h3>Danh sách người xử lý bạn đã chọn:</h3>
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
			<div>
				<input type="text" id="result1" name="tensuco" width="200px" placeholder="Tên kỹ thuật xử lý" value="" required disabled />
			</div>

     <br />  
     <label>Ước lượng thời gian</label>
     <input type="date" name="thoigian" id="designation" class="form-control" />
     <br />  
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

    </form>
   </div> 
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


<!--Xem thong tin cong viec-->
<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 align="center" class="modal-title">Thông tin công việc</h4>
   </div>
   <div class="modal-body" id="employee_detail">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<!--Form cap nhat trang thai cua su co-->

<div id="trangthaiupdate" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 align="center" class="modal-title">Thông tin công việc trạng thái</h4>
   </div>
	  <form method="post" id="updatett">
		   			
   <div class="modal-body" id="xulytrangthai">
    
   </div>
<!--
	  <div id="div1"><input type="button" name="capnhat1" id="" class="btn1" value="Đang xử lý" onclick="update()"/></div>
	  <div id="div2"><input type="button" name="capnhat2" class="btn btn-info btn-xs" value="Hoàn thành" onclick="reload()"/></div>
-->
	</form>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="reload()">Close</button>
   </div>
  </div>
 </div>
</div>

<!--JavaScript-->
<script>  
//	Xu ly sumit them vao csdl cho form insert
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#congviec').val() == "")  
  {  
   alert("Name is required");  
  }  
  else if($('#nguoigiaiquyet').val() == '')  
  {  
   alert("Address is required");  
  }  
  else if($('#thoigian').val() == '')
  {  
   alert("Designation is required");  
  }
   
  else  
  {  
   $.ajax({  
    url:"../insert.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     $('#employee_table').html(data);  
		location.reload();
    }  
   });  
  }  
 });

//Xem 1 thong tin cong viec cua su co
 $(document).on('click', '.view_data', function(){
	 
  //$('#dataModal').modal();
	 var name =$(this).attr("name");
	 if(name=="view"){
		 	var employee_id = $(this).attr("id");
			$.ajax({
			   url:"select.php",
			   method:"POST",
			   data:{employee_id:employee_id},
			   success:function(data){
				$('#employee_detail').html(data);
				$('#dataModal').modal('show');
			   }
			  });
		}
		else
		{ 
			var trangthai = $(this).attr("id");
			var val = $(this).attr("value");
			var namesuco = $(this).attr("name");
//			var div1 = document.getElementById('div1');
//			var div2 = document.getElementById('div2');
//			if(val=="Đã gửi"){
//				div1.style.display='block';
//				div2.style.display='none';
//			}else if(val=="Đang xử lý"){
//					div1.style.display='none'; 
//					div2.style.display='block';
//				}
//			else {
//				div1.style.display='none'; 
//				div2.style.display='none';
//			}
			$.ajax({
			   url:"update.php",
			   method:"POST",
			   data:{trangthai:trangthai,namesuco:namesuco},
			   success:function(data){
				$('#xulytrangthai').html(data);
				$('#trangthaiupdate').modal('show');
			   }
			  });
		}
  
		
  
 });
});  
//	 Ham xu ly reload
	function reload(){
		setTimeout('location.reload()',200);
		
	}
	
	//Ham cap nhat trangthai
//	function update(){
//		var idgq = $(this).attr("id");
//		var valgq = $(this).attr("value");
//		var idgq1 = document.getElementById(this);
//		alert(idgq);
//		$.ajax({
//			url: "updatett.php",
//			method: "post",
//			date:{idsq:idgq,valgq:valgq},
//			success:function(data){
//				$('#xulytrangthai').html(data);
//				$('#trangthaiupdate').modal('show');
//			}
//			
//		});
//	}
	
//	$(document).ready(function(){
//		$('#div1').click(function(e){
//			var idgq = $(this).attr("id");
//		var valgq = $(this).attr("value");
//			alert(valgq);
//		});
//	});

//	$(document).on('click', '.btn1', function(){
//		
//		var idgq = $(this).attr("id");
//		var valgq = $(this).attr("value");
//			alert(idgq);
//	});
 </script>
<?php 
//	$connect = mysqli_connect("localhost", "root", "", "helpdesk1");
//	if(isset($_GET['idgq'])){
//		$idgq = $_GET['idgq'];
//		$val = $_GET['trangthai'];
//			$sql_update = " update giaiquyet set trangthai=1";
//			$db->excute($sql_update);
//		
//	}
?>