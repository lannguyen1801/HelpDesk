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
 	$sqluser="SELECT * FROM faq";
    $queryuser=mysqli_query($conn,$sqluser);
	$kq=$conn->query($sqluser);
    $row1= $kq->fetch_assoc();
	$idsuco = $row1['idfaq'];
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
                                <a href="../../logout.php" onclick="return confirmAction()">
                                    <img src="../../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát">
                                </a>
                            </div>
                            <div id="logout" style="margin-top:3px; padding:0; ">
                                <a href="../quanly.php">
                                    <img src="../../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ">
                                </a>
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
                    <ol style="background-color: white;" class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../quanly.php"><i class="fa fa-home"></i>  Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../duyetfaq/duyetfaq.php">Danh sách câu hỏi (FAQ)</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->

            <!-- <div id="menu">
                <ul>
                  <li><a href="Listuser.php">Liệt kê</a></li>
                    <li><a href="../themfaq.php"><b style="color:#fbf424;">Thêm mới câu hỏi</b></a></li>
                </ul>
            </div> -->
            <br><br>
            <div style="text-align: center" >
                <h2>Danh sách câu hỏi thường gặp</h2>
            </div>
			<form method="get">
            <div id="table" style="margin: auto;width: 1100px">
                <table border="1px" class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                    <thead>
                        <tr align="center">
                            <th style="text-align: center;" width="5%">STT</th>
                            <th  style="text-align: center;" width="40%">Tiêu đề</th>		
							<th  style="text-align: center;" width="45%">Giải tuyết</th>
							<th  style="text-align: center;" width="10%">Thao tác</th>
<!--                            <th>Hành động</th>-->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($queryuser)){
                      echo  '<tr class="odd gradeX" align="center">';
                      echo  '<td>'.$i++.'</td>';
              
                      echo  '<td style="text-align: left;">'.$userList["tieude"].'</td>';
					
						
//						$hinhanh=../../themsuco/.$userList;
						echo '<td style="text-align: left;" >'.$userList["giaiquyet"].'</td>';
						echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="delfaq.php?id='.$userList["idfaq"].'" onclick="return confirmAction1()"> Xóa</a><br>
                                <i class="fa fa-pencil fa-fw"></i> <a href="../suafaq.php?id='.$userList["idfaq"].'">Sửa</a></td>';
                    //  echo  '<td>'.$userList["trangthai"].'</td>';
                     
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
            function confirmAction1() {
                return confirm("Bạn có chắc muốn xóa câu hỏi này ?")
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
