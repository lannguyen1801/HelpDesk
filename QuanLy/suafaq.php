
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
    $sqlcb="SELECT  * FROM  `faq` WHERE idfaq='$macanbo';";
    $resulcb=mysqli_query($conn,$sqlcb);
    while ($ifList=mysqli_fetch_array($resulcb)){
		$idfaq=$ifList["idfaq"];
        $tieude=$ifList["tieude"];
        $giaiquyet=$ifList["giaiquyet"];
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
    $idfaq=$_POST["id"];
   
    $tieude=$_POST["tieude"];
    $giaiquyet=$_POST["post_content"];

 //   $hoanthanh=$_POST["hoanthanh"];
//    $slqcv="SELECT suco.* FROM suco WHERE idsuco='$idsc'";
//    $resul=mysqli_query($conn,$slqcv);
//    $tenchucvu=mysqli_fetch_assoc($resul);
//    $nameCV=$tenchucvu["TenChucVu"];
//    $ngaysinh=$_POST["ngaysinh"];
//    $stt=$_POST["stt"]; // 1 hiện 0 ẩn
    $nvsql="UPDATE `faq` SET
        `tieude`='$tieude',`giaiquyet`='$giaiquyet' WHERE idfaq = '$idfaq' ";
//    mysqli_query($conn,$nvsql);
//    $usql="UPDATE taikhoan SET `TRANGTHAI`=$stt,`CAPDO`=$chucvu, NgayUpDate= CURRENT_DATE WHERE MACB='$manv' ;";
    if(mysqli_query($conn,$nvsql)){
        $ero=0;
        header('Location: suafaq.php?id='.$idfaq.'&eror='.$ero);
    }else {
        $ero=1;
        header('Location: suafaq.php?id='.$idfaq.'&eror='.$ero);
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
            <div class="col-lg-5">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/quanly.php"><i class="fa fa-home"></i>  Quản Lý</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/duyetfaq/duyetfaq.php"> Danh sách câu hỏi (FAQ)</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../QuanLy/suafaq.php">Chỉnh sửa FAQ</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
            <br><br>
            
             <!-- End Thêm thanh điều hướng_Tiên_20/06 -->

    <!-- <div id="menu">
        <ul>
           <li><a href="Listuser.php">Liệt kê</a></li>
            <li><a href="themfaq.php"><b style="color:#fbf424;">Thêm mới câu hỏi</b></a></li>
        </ul>
    </div> -->
    
    <div style="text-align: center" >
        <h2>Chỉnh sửa câu hỏi thường gặp</h2>
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
    <form action="suafaq.php" method="POST" id="formseddit">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1"></div>
            <div class="col-md-4">
				<div class="form-group">

                    <label for="usr">ID</label>
                    <?php echo '<input type="text"  name="id" class="form-control" id="usr" value="'.$idfaq.'" readonly>';?>
                    <p class="text-danger" id="msg"></p>
                </div>
               
                <div class="form-group">
                    <label for="usr1">Tiêu đề</label>
                    <?php echo '<textarea type="text" name="tieude"  class="form-control" id="mota" placeholder="">'.$tieude.'</textarea>';?>

                </div>
				
				
       
            </div>
			
            <div class="col-md-4">
				
				
				<div class="form-group">
                    <label for="exampleInputEmail1">Giải quyết</label>
                   <?php echo '<textarea name="post_content" id="post_content" placeholder="" class="form-control"  >'.$giaiquyet.'</textarea>';?>
                </div>

                <input class="btn btn-success" name="btedit" type="submit" value="Sửa đổi">
                <a href="duyetfaq/duyetfaq.php" class="btn btn-primary">Quay lại </a>
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