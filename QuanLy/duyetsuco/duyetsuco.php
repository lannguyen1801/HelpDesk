<?php
	

       session_start();
//	if (isset($_SESSION['idtaikhoan'])) {
//		$taikhoan = $_SESSION['idtaikhoan'];
//	  }
   // include ('../db/pgiangvien.php');
    $id=$_SESSION['idtaikhoan'];
    require ('../../conn.php');
mysqli_set_charset($conn, 'UTF8');
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
 	$sqluser="SELECT suco.*,trangthai.trangthai FROM suco,trangthai 
              WHERE suco.trangthaiduyet=trangthai.idtrangthai";
    $queryuser=mysqli_query($conn,$sqluser);
	$kq=$conn->query($sqluser);
    $row1= $kq->fetch_assoc();
	$idsuco = $row1['idsuco'];
	$i=1;
?>
    <!DOCTYPE html>
    <html >

    <head>
        <title>Hệ thống quản lý sự cố Helpdesk</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../public/css/stylechitiet.css">
		<link rel="stylesheet" href="../../public/css/menustyle.css">
		<style>
			td img{
				width: 100px;
				height: 50px;
			}
		</style>
    </head>

    <body style="background: #fffff; padding: 0px; margin: 0px;">
        <div class="Container">
            <div class="row">
                <div id="header">
                    <div id="webname">
						<div style="font-family: Time New Roman;color: aqua; font-size: 25px; width: 800px;float: left"><b><span style="color: yellow ; font-size: 40px;">H</span><span style="color: white ;">Ệ THỐNG QUẢN LÝ</span><br>&emsp;<span style="font-family: Arial;"> SỰ CỐ HELPDESK</span></b> </div>
                        <div id="header_icon">
                            <div id="home">
                                <a href="../../logout.php" onclick="return confirmAction()"><img src="../../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a>
                            </div>
                            <div id="logout" style="margin:0px; padding:0; ">
                                <a href="../quanly.php"><img src="../../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a>
                            </div>
                            <div id="name"><strong style="color: #e0f74f"><?php echo $name.'  ('. $Mnv.')' ?></strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <!-- Start Thêm  thanh điều hướng_Tiên_20/06 -->
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol style="background-color: white;" class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../quanly.php"><i class="fa fa-home"></i>   Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../duyetsuco/duyetsuco.php">Danh sách sự cố</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            <br><br>
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->
<!-- 
            <div id="menu">
                <ul>
                   <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="../themsuco.php"><b style="color:#fbf424;">Thêm mới</b></a></li>
                </ul>
            </div> -->
            <div style="text-align: center" >
                <h2>Danh sách sự cố</h2>
            </div>
			<form method="get">
            <div id="table" style="margin: auto;width: 1100px">
                <table border="1px" class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr align="center">
                            <th style="text-align: center;" width="5%">STT</th>
                            <th style="text-align: center;" width="11%">Tên sự cố</th>
                            <th style="text-align: center;"  width="11%">Mô tả sự cố</th>
							<th style="text-align: center;" width="9%">Phòng</th>
							<th style="text-align: center;" width="5%">Số máy</th>
							<th style="text-align: center;" width="9%">Thiết bị hỏng</th>
                            <th style="text-align: center;" width="7%">Mức độ</th>
							<th style="text-align: center;" width="11%">Thông tin thêm</th>
							<th style="text-align: center;" width="11%">Ngày tạo</th>
							<th style="text-align: center;" width="11%">Ngày dự kiến hoàn thành</th>
                            <th style="text-align: center;" width="9%">Trạng thái</th>
							<th style="text-align: center;" width="9%">Thao tác</th>
<!--                            <th>Hành động</th>-->
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($queryuser)){
                      echo  '<tr class="odd gradeX" align="center" height="100px">';
                      echo  '<td>'.$i++.'</td>';
                      echo  '<td >'.$userList["tensuco"].'</td>';
                      echo  '<td>'.$userList["motasuco"].'</td>';
					  echo  '<td>'.$userList["sophong"].'</td>';
					  echo  '<td>'.$userList["somay"].'</td>';
					   if($userList["thietbihong"]=="0")
					  echo  '<td >Máy PC</td>';
					elseif($userList["thietbihong"]=="1")
					 echo  '<td >Laptop</td>';
					 elseif($userList["thietbihong"]=="2")
					 echo  '<td >Máy tính bảng</td>';
					  elseif($userList["thietbihong"]=="3")
					 echo  '<td >Điện thoại</td>';
					  elseif($userList["thietbihong"]=="4")
					 echo  '<td >Máy in</td>';
					  elseif($userList["thietbihong"]=="5")
					 echo  '<td >Máy fax</td>';


                    if($userList["mucdo"]=="0")
                      echo  '<td >//</td>';
                    elseif($userList["mucdo"]=="1")
                     echo  '<td >Nhẹ</td>';
                    elseif($userList["mucdo"]=="2")
                     echo  '<td >Trung bình</td>';
                     elseif($userList["mucdo"]=="3")
                     echo  '<td >Nặng</td>';
                      





					  echo '<td >'.$userList["hinhanh"].'</td>';
//						$hinhanh=../../themsuco/.$userList;
						echo  '<td>'.$userList["thoigianyeucau"].'</td>';
						echo  '<td>'.$userList["thoigianhoanthanh"].'</td>';

                        if($userList["trangthai"]=="Hoàn thành")
                      echo  '<td><a href="../edituser.php?id='.$userList["idsuco"].'" class="btn  btn-success" >'.$userList["trangthai"].'</a></td>';
                    elseif($userList["trangthai"]=="Chưa duyệt")
                     echo  '<td><a href="../edituser.php?id='.$userList["idsuco"].'" class="btn btn-danger" >'.$userList["trangthai"].'</a></td>';
                    elseif($userList["trangthai"]=="Đang xử lý")
                     echo  '<td><a href="../edituser.php?id='.$userList["idsuco"].'" class="btn btn-warning" >'.$userList["trangthai"].'</a></td>';
                     elseif($userList["trangthai"]=="Đã duyệt")
                     echo  '<td><a href="../edituser.php?id='.$userList["idsuco"].'" class="btn btn-primary" >'.$userList["trangthai"].'</a></td>';



						// echo '<td><a href="../edituser.php?id='.$userList["idsuco"].'" class="btn btn-primary" >'.$userList["trangthai"].'</a></td>';
                    //  echo  '<td>'.$userList["trangthai"].'</td>';
						echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="del.php?id='.$userList["idsuco"].'" onclick="return confirmAction()"> Xóa</a>
                        
                                <i class="fa fa-pencil fa-fw"></i> <a href="../sua.php?id='.$userList["idsuco"].'">Sửa</a></td>';
                        echo '</tr>';
                    }
                      ?>
                    </tbody>
                </table>
            </div>
		</form>
        </div>
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    order: [
                        [0, 'asc']
                    ],
                    'language': {
                        'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ nhân viên',
                        'lengthMenu': "Hiển thị _MENU_ nhân viên",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "paginate": {
                            "previous": "Trước",
                            "next": "Sau",
                            "infoEmpty": "Không có dữ liệu"

                        },
                        "search": "Lọc / Tìm kiếm:"
                    },
                });
            });

        </script>
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn xóa sự cố này ? ")
            }
	

        </SCRIPT>
        <!-- Tiên 22/06 -->
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction() {
                return confirm("Bạn có chắc muốn đăng xuất ?")
            }
    

        </SCRIPT>
       <?php include '../footer.php';?>
    </body>

    </html>
