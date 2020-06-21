
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

if(isset($_GET["id"])){
    $macanbo=$_GET["id"];
    require ('../conn.php');
    $sqlcb="SELECT  * FROM  `suco` WHERE idsuco='$macanbo';";
    $resulcb=mysqli_query($conn,$sqlcb);
    while ($ifList=mysqli_fetch_array($resulcb)){
		$idsuco=$ifList["idsuco"];
        $tensuco=$ifList["tensuco"];
        $motasuco=$ifList["motasuco"];
        $hinhanh=$ifList["hinhanh"];
		$sophong=$ifList["sophong"];
		$somay=$ifList["somay"];
		$thietbihong=$ifList["thietbihong"];
        //$mucdohong=$ifList["mucdo"];
        $thoigianyeucau=$ifList["thoigianyeucau"];
        $thoigianhoanthanh=$ifList["thoigianhoanthanh"];
        $trangthaiduyet=$ifList["trangthaiduyet"];
    }
//    $sqluser="SELECT  * FROM  taikhoan WHERE MACB='$macanbo';";
//    $resuluser=mysqli_query($conn,$sqluser);
//    while ($ifurList=mysqli_fetch_array($resuluser)){
//        $ifurUser=$ifurList["USERNAME"];
//        $ifurStt=$ifurList["TRANGTHAI"];
//        $ifurCapdo=$ifurList["CAPDO"];
//    }

}
if(isset($_POST["btedit"])) {
    require ('../conn.php');
//    $sqldsbophaan="SELECT * FROM `suco`;";
//    $qbp=mysqli_query($conn,$sqldsbophaan);
//    $num=mysqli_num_rows($qbp);
//    $dsbp=mysqli_fetch_assoc($qbp);
//    //
//    //
    $idsc=$_POST["id"];
    $name=$_POST["tensuco"];
    $mota=$_POST["mota"];
    $thongtin=$_POST["post_content"];
	$sp=$_POST["sophong"];
	$sm=$_POST["somay"];
	$tbh=$_POST["thietbihong"];
    //$md=$_POST["mucdo"];
    $hoanthanh=$_POST["hoanthanh"];
//    $slqcv="SELECT suco.* FROM suco WHERE idsuco='$idsc'";
//    $resul=mysqli_query($conn,$slqcv);
//    $tenchucvu=mysqli_fetch_assoc($resul);
//    $nameCV=$tenchucvu["TenChucVu"];
//    $ngaysinh=$_POST["ngaysinh"];
//    $stt=$_POST["stt"]; // 1 hiện 0 ẩn
    $nvsql="UPDATE `suco` SET
        `tensuco`='$name',`motasuco`='$mota',`hinhanh`='$thongtin',`sophong`='$sp',`somay`='$sm',`thietbihong`='$tbh',
        `thoigianhoanthanh`='$hoanthanh' WHERE idsuco = '$idsc' ";
//    mysqli_query($conn,$nvsql);
//    $usql="UPDATE taikhoan SET `TRANGTHAI`=$stt,`CAPDO`=$chucvu, NgayUpDate= CURRENT_DATE WHERE MACB='$manv' ;";
    if(mysqli_query($conn,$nvsql)){
        $ero=0;
        header('Location: sua.php?id='.$idsc.'&eror='.$ero);
    }else {
        $ero=1;
        header('Location: sua.php?id='.$idsc.'&eror='.$ero);
    }


}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hệ thống quản lý Helpdesk</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
		
		<link rel="stylesheet" href="../public/css/stylePanel.css">
		<link rel="stylesheet" href="../public/css/menustyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../public/css/stylechitiet.css">
		<script src="../ckeditor/ckeditor.js"></script>

        <link rel="stylesheet" href="../../public/css/stylechitiet.css"><!-- Tiên 20/06 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- Tiên 20/06 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><!-- Tiên 20/06 -->


</head>

<body style="background: #FFFFFF; padding: 0px; margin: 0px;">
<div class="Container">
    <div class="row">
        <div id="header">
            <div id="webname"><div style="color: aqua; font-size: 40px; width: 800px;float: left">Hệ thống quản lý sự cố Helpdesk</div>
                <div id="header_icon">
                    <div id="home" ><a href="../logout.php"><img src="../public/img/nhanvienlogin/thoat.png" style="margin-top: 20px" alt="Thoát"></a></div>
                    <div id="logout" style="margin:0px; padding:0; "><a href="quanly.php"><img src="../public/img/nhanvienlogin/trangchu.png" style="margin: 0px;" alt="Trang chủ"></a></div>
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/quanly.php"><i class="fa fa-home"></i>   Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/duyetsuco/duyetsuco.php">Danh sách sự cố</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/sua.php">Chỉnh sửa sự cố</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            <br><br>
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->

   <!--  <div id="menu">
        <ul>
            <li><a href="Listuser.php">Liệt kê</a></li>
            <li><a href="themsuco.php"><b style="color:#fbf424;">Thêm mới</b></a></li>
        </ul>
    </div> -->
    <div style="text-align: center" >
        <h2>Chỉnh sửa sự cố</h2>
    </div><!--Tiên_20/06 -->

    
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <?php
            if(isset($_GET['eror'])){
                $error=$_GET['eror'];
                if($error==0 ){
                    echo '<div class="alert alert-success alert-dismissable">';
                    echo    '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                    echo   '<strong>Thành công!</strong>Chỉnh sửa thành công';
                    echo '</div>';}
                else if($error==1){
                    echo ' <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Thêm thất bại!</strong> Có lỗi khi chỉnh sửa
                  </div>';
                }
            }
            ?>
        </div>
        <div class="col-md-1"> </div>
    </div>
    <form action="sua.php" method="POST" id="formseddit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-4">
				<div class="form-group">

                    <label for="usr">ID</label>
                    <?php echo '<input type="text"  name="id" class="form-control" id="usr" value="'.$idsuco.'" readonly>';?>
                    <p class="text-danger" id="msg"></p>
                </div>
                <div class="form-group">

                    <label for="usr">Tên sự cố</label>
                    <?php echo '<input type="text"  name="tensuco" class="form-control" id="usr" value="'.$tensuco.'" >';?>
                    <p class="text-danger" id="msg"></p>
                </div>
                <div class="form-group">
                    <label for="usr1">Mô tả sự cố</label>
                    <?php echo '<input type="text" name="mota" value="'.$motasuco.'" class="form-control" id="mota" placeholder="Nguyễn Văn A">';?>

                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">Thời gian dự kiến hoàn thành</label>
                    <?php echo '<input type="date" name="hoanthanh" class="form-control" value="'.$thoigianhoanthanh.'" id="hoanthanh" placeholder="dd-mm-yyyy" readonly="">';?>
                </div>
				<div class="form-group">
                    <label for="usr">Phòng</label>
                    <select name="sophong" class="form-control" id="sel2">
                        <?php
                        $sql1='SELECT * FROM phongban;';
                        $result=mysqli_query($conn,$sql1);
                        while ($dscv=mysqli_fetch_array($result)){
                            if($dscv["ten"]==$sophong){
                                echo '<option value="'.$dscv["ten"].'" selected>'.$dscv["ten"].'</option>';
                            } else {
                                echo '<option value="'.$dscv["ten"].'">'.$dscv["ten"].'</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group">

                    <label for="usr">Số máy</label>
                    <?php echo '<input type="text"  name="somay" class="form-control" id="usr" value="'.$somay.'" >';?>
                    <p class="text-danger" id="msg"></p>
                </div>
				

            </div>
			
            <div class="col-md-4">
				<div class="form-group">
                    <label for="usr">Thiết bị hỏng</label>
                    <select name="thietbihong" class="form-control" id="sel2">
                      <?php
                                if($thietbihong=="0"){
                                echo '<option value="'.$thietbihong.'" selected>Máy PC</option>';
                                 echo '
                                 
                                
                                  <option value="1">Laptop</option>
                                  <option value="2">Máy tính bảng</option>
                                  <option value="3">Điện thoại</option>
                                  <option value="4">Máy in</option>
                                  <option value="5">Máy fax</option>
                                ';}
                                elseif($thietbihong=="1"){
                                echo '<option value="'.$thietbihong.'" selected>Laptop</option>';
                                echo '
                                  <option value="0">Máy PC</option>
                                
                                  <option value="2">Máy tính bảng</option>
                                  <option value="3">Điện thoại</option>
                                  <option value="4">Máy in</option>
                                  <option value="5">Máy fax</option>
                                ';}
                                elseif($thietbihong=="2"){
                                echo '<option value="'.$thietbihong.'" selected>Máy tính bảng</option>'; 
                                echo '
                                   <option value="0">Máy PC</option>
                                  <option value="1">Laptop</option>
                            
                                  <option value="3">Điện thoại</option>
                                  <option value="4">Máy in</option>
                                  <option value="5">Máy fax</option>
                                ';}
                                elseif($thietbihong=="3"){
                                echo '<option value="'.$thietbihong.'" selected>Điện thoại</option>'; 
                                echo '
                                   <option value="0">Máy PC</option>
                                  <option value="1">Laptop</option>
                                  <option value="2">Máy tính bảng</option>
                            
                                  <option value="4">Máy in</option>
                                  <option value="5">Máy fax</option>
                                ';}
                                elseif($thietbihong=="4"){
                                echo '<option value="'.$thietbihong.'" selected>Máy in</option>';
                                echo '
                                   <option value="0">Máy PC</option>
                                  <option value="1">Laptop</option>
                                  <option value="2">Máy tính bảng</option>
                                  <option value="3">Điện thoại</option>
                            
                                  <option value="5">Máy fax</option>
                                ';}
                                elseif($thietbihong=="5"){
                                echo '<option value="'.$thietbihong.'" selected>Máy fax</option>';
                                 echo '
                                  <option value="0">Máy PC</option>
                                  <option value="1">Laptop</option>
                                  <option value="2">Máy tính bảng</option>
                                  <option value="3">Điện thoại</option>
                                  <option value="4">Máy in</option>
                            
                                ';} 
                        ?>
                    </select>
                </div>

				
				
				<div class="form-group">
                    <label for="exampleInputEmail1">Thông tin thêm</label>
                   <?php echo '<textarea name="post_content" id="post_content" placeholder="" class="form-control"  >'.$hinhanh.'</textarea>';?>
                </div>

                <input class="btn btn-success" name="btedit" type="submit" value="Sửa đổi">
                <a href="duyetsuco/duyetsuco.php" class="btn btn-primary">Quay lại </a>
<!--                <a href="doimatkhau.php?id=<?php echo $macanbo; ?>" class="btn btn-primary">Thay đổi mật khẩu </a>-->
            </div>
        </div>

    </form>

</div>
  <?php include 'footer.php';?>

</body>
<!--
<script type="text/javascript">
    $.validator.addMethod("dateFormat",
        function(value, element) {
            return value.match(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
        },
        "Nhập đúng định dạng dd-mm-yyyy.");
    $(function(){
        var validate = $("#formseddit").validate({
            rules :{
                tensuco :{
                    required :true,
                },
                motasuco :{
                    email:true,
                    required: true,
                },
                ngaysinh :{
                    dateFormat:true
                }
            },
            messages :{
                ten_nhan_vien :{
                    required:"Không được bỏ trống",
                },
                email:{
                    email: "Nhập sai định dạng",
                    required: "Đây là trường bắt buộc"
                }

            }
        });

    });
</script>
-->
</html>
<script>
						var url = 'http://localhost/helpdesk';
							// Thay thế <textarea id="post_content"> với CKEditor
							CKEDITOR.replace( 'post_content',{
								uiColor: '#9AB8F3',
								filebrowserBrowseUrl: url+'/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: url+'/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							
								
							} );// tham số là biến name của textarea
						</script>