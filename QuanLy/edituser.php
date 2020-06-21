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
	$querysuco = "select * from suco,trangthai where suco.idsuco=$idsc and trangthai.idtrangthai=suco.trangthaiduyet";
	$resultsuco = mysqli_query($conn,$querysuco);
	$kq1suco=$conn->query($querysuco);
	$row2suco= $kq1suco->fetch_assoc();
	$trangthaiduyet = $row2suco['trangthai'];
	$trangthai=$row2suco['trangthaiduyet'];
	if($trangthai==0){
		$query = "select * from suco,trangthai where suco.idsuco=$idsc and trangthai.idtrangthai=suco.trangthaiduyet";
		$result = mysqli_query($conn,$query);
		$kq1=$conn->query($query);
		$row2= $kq1->fetch_assoc();
		$tensuco=$row2['tensuco'];
		$motasuco=$row2['motasuco'];
		$thongtin=$row2['hinhanh'];
		$thietbihong=$row2['thietbihong'];
		$trangthai=$row2['trangthai'];
		$ngaytao=$row2['thoigianyeucau'];
		$hoanthanh=$row2['thoigianhoanthanh'];
		$querytt = "update suco set trangthaiduyet=1 where idsuco = '$idsc'";
			if($conn->query($querytt)==true){
				echo "update thành công";
				echo "<script language='javascript'>
										
											location.reload();
								</script>"; 
				
			}else {
				echo "Update thất bại ";
			}
		echo $trangthai;
		
	}else if($trangthai==1){
		$query = "select * from suco,trangthai where suco.idsuco=$idsc and trangthai.idtrangthai=suco.trangthaiduyet";
		$result = mysqli_query($conn,$query);
		$kq1=$conn->query($query);
		$row2= $kq1->fetch_assoc();
		$tensuco=$row2['tensuco'];
		$motasuco=$row2['motasuco'];
		$thongtin=$row2['hinhanh'];
		$thietbihong=$row2['thietbihong'];
		$mucdohong=$row2['mucdo'];
//		$trangthai=$row2['trangthai'];
		$ngaytao=$row2['thoigianyeucau'];
		$hoanthanh=$row2['thoigianhoanthanh'];
	}else {
		$query = "select * from suco,giaiquyet,taikhoan,trangthaicv where giaiquyet.id=suco.idsuco and suco.idsuco=$idsc and taikhoan.idtaikhoan=giaiquyet.nguoigiaiquyet and giaiquyet.trangthai=trangthaicv.id";
		$result = mysqli_query($conn,$query);
		$kq1=$conn->query($query);
		$row2= $kq1->fetch_assoc();
		$tensuco=$row2['tensuco'];
		$motasuco=$row2['motasuco'];
		$thongtin=$row2['hinhanh'];
		$thietbihong=$row2['thietbihong'];
		$mucdohong=$row2['mucdo'];
//		$trangthai=$row2['trangthai'];
		$ngaytao=$row2['thoigianyeucau'];
		$hoanthanh=$row2['thoigianhoanthanh'];
	}
//	$query = "select * from suco,giaiquyet,taikhoan,trangthaicv where giaiquyet.id=suco.idsuco and suco.idsuco=$idsc and taikhoan.idtaikhoan=giaiquyet.nguoigiaiquyet and giaiquyet.trangthai=trangthaicv.id";
//    $result = mysqli_query($conn,$query);
//	$kq1=$conn->query($query);
//	$row2= $kq1->fetch_assoc();
//	$tensuco=$row2['tensuco'];
//	$motasuco=$row2['motasuco'];
//	$trangthai=$row2['trangthai'];
//	$ngaytao=$row2['thoigianyeucau'];
//	if($trangthai==""){
//		$querysc = "select * from suco,trangthai where suco.idsuco=$idsc and trangthai.idtrangthai=suco.trangthaiduyet";
//		$resultsc = mysqli_query($conn,$querysc);
//		$kq1sc=$conn->query($querysc);
//		$row2sc= $kq1sc->fetch_assoc();
//		$tensuco=$row2sc['tensuco'];
//		$motasuco=$row2sc['motasuco'];
//		$trangthai=$row2sc['trangthai'];
//		$ngaytao=$row2sc['thoigianyeucau'];
//		
//		$querytt = "update suco set trangthaiduyet=1 where idsuco = '$idsc'";
//			if($conn->query($querytt)==true){
//				echo "update thành công";
//				echo $trangthai;
//			}else {
//				echo "Update thất bại: ";
//			}
//	}

//Truy xuất Ajax phân công người xử lý
	$sqluser="SELECT * FROM taikhoan where taikhoan.IDnhomnguoidung=20002";
	$queryuser=mysqli_query($conn,$sqluser);
	$conn->close();
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
<!--		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
		
<!--		<link rel="stylesheet" href="../public/css/stylePanel.css">-->
<!--		<link rel="stylesheet" href="../public/css/menustyle.css">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--		<link rel="stylesheet" href="../public/css/stylechitiet.css">-->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/stylechitiet.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
		<script src="../ckeditor/ckeditor.js"></script>
		<style>
			td img{
				width: 100px;
				height: 50px;
			}
		</style>
    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;" onload="hienthi()">
        <div class="Container">
            <div class="row">
                <div id="header">
                  <div id="webname">
<!--					  <img src="../img/icon.png" style="width: 50px;height: 50px;" >-->
						<div style="margin-top:10px;font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" 			alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin-top:3px; padding:0; ">
                                <a href="quanly.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" 				alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
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
                            <a href="../QuanLy/quanly.php"><i class="fa fa-home"></i>   Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/duyetsuco/duyetsuco.php">Danh sách sự cố</a>
                        </li>
                         <li class="breadcrumb-item">
                            <a href="">Xem chi tiết sự cố</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            <br><br>
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->

            <!-- <div id="menu">
                <ul>
                   <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="themsuco.php"><b style="color:#fbf424;">Thêm mới</b></a></li>
                </ul>
            </div> -->
			<div style="width:1000px; margin: auto;">
				<h3 align="center">Sự cố</h3>
					<table width="89%" height="50" class="table table-bordered" >
					<tr>
						<th style="text-align: center;" width="5%">ID</th>
						<th style="text-align: center;" width="9%">Tên sự cố</th>
						<th style="text-align: center;"width="15%">Mô tả</th>
						<th style="text-align: center;"width="10%">Thông tin</th>
						<th style="text-align: center;"width="9%">Thiết bị hỏng</th>
						<th style="text-align: center;"width="9%" >Mức độ</th>
						<th style="text-align: center;"width="9%">Trạng thái</th>
						<th style="text-align: center;"width="12%">Ngày tạo</th>
						<th style="text-align: center;"width="12%">Dự kiến hoàn thành</th>
					</tr>
					<tr align="center">
						<td><?php echo $idsc?></td>
						<td><?php echo $tensuco?></td>
						<td><?php echo $motasuco?></td>
						<td><?php echo $thongtin?></td>
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

					if($mucdohong=="0")
                      echo  '<td >//</td>';
                    elseif($mucdohong=="1")
                     echo  '<td >Nhẹ</td>';
                    elseif($mucdohong=="2")
                     echo  '<td >Trung bình</td>';
                     elseif($mucdohong=="3")
                     echo  '<td >Nặng</td>';
					?>

						<td><div id="kiemtra" name="<?php echo $trangthaiduyet?>"><?php echo $trangthaiduyet?></div></td>
						<td><?php echo $ngaytao?></td>
						<td><?php echo $hoanthanh?></td>
					</tr>
				</table>
			</div>
			<form method="post">
				<div class="container" style="width:1000px;">  
				   <h3 align="center">Các công việc cần xử lý</h3>  
				   <br />  
				   <div class="table-responsive">
					<div align="right">
					 <button type="button" name="id" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary">Phân công và đánh giá công việc</button>
					</div>
					<br />
					<div id="employee_table">

			<table class="table table-bordered" id="tablecv">
				<tr>
					<th width="5%">STT</th>
					<th width="26%">Công việc</th> 
					<th width="24%">Người xử lý</th>
					<th width="28%">Trạng thái</th>
					<th width="17%">Xem</th>
				</tr>
					  <?php
					  while($row = mysqli_fetch_array($result))
					  {
					  ?>
					  <tr>
						<td><?php echo $i++; ?></td>
					   <td><?php echo $row["congviec"]; ?></td>
						  <td><?php echo $row["taikhoan"]; ?></td>

						





						<td><input type="button" value="<?php echo $row["trangthai"]; ?>" class="btn btn-info btn-xs view_data"/></td> 
						  
					    <td><input type="button" name="view" value="Xem" id="<?php echo $row["idgq"]; ?>" class="btn btn-info btn-xs view_data" /></td>
					  </tr>
					  <?php
					  }
					  ?>
			</table>
					</div>
				   </div>  
				  </div>
				<div id="">
					<input type="submit" style="display: none;" class="btn btn-success" name="btnsubmit" value="Gui">
					<input type="reset" style="display: none;" class="btn btn-primary" name="btnreset" value="Dat lai">
				</div>
			</form>
        </div>
         <?php include 'footer.php';?>
		<div id="chitietsp"></div>
		<div id="hienthihinhanh"></div>
    </body>
</html>

<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" align="center">Phân công và đánh giá công việc</h4>
   </div>	  
   <div class="modal-body">
    <form method="post" id="insert_form">
		
     <label>ID</label>
     <input type="text" name="id" id="name" class="form-control" value="<?php 
			echo $idsc; ?>" readonly/>
     <br />
     <label>Xử lý công việc</label>
     <textarea name="congviec" id="address" class="form-control"><?php echo $tensuco?></textarea>
     <br>
     <label>Đánh giá mức độ</label>
    <select name="mucdohu" id="gender" class="form-control" onchange="validateSelectBox(this)">
    	<option value=""> -- Chọn -- </option>
			<option value="1">Nhẹ</option>
			<option value="2">Trung bình</option>
			<option value="2">Nặng</option>
	</select>
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

<script>  
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#congviec').val() == "")  
  {  
   alert("Name is required");  
  }
  else if($('#mucdohu').val() =="")
  {  
   alert("Muc do is required");  
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
//     $('#employee_table').html(data); 
		location.reload();
    }  
   });  
  }  
 });




 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"../select.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#employee_detail').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
});  
	function hienthi(){
		var suco = document.getElementById('tablecv');
		var id = $('#kiemtra').attr("name");
		if(id=="Đã duyệt"||id=="Chưa duyệt"){
			suco.style.display='none';
		}
	}
 </script>