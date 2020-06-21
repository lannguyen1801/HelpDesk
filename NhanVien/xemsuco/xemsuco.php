<?php
	$con = new mysqli("localhost","root","","helpdesk1");
    session_start();
    if(isset($_SESSION['idtaikhoan'])){
        $taikhoan =$_SESSION['idtaikhoan']; 
		$sql = "select * from taikhoan where idtaikhoan='$taikhoan'";
		$kq=$con->query($sql);
    	$row= $kq->fetch_assoc();
    }
//    else{
//        header("location:../../index.php");
//    }
	$trangthai='0';
	$sql="SELECT * from suco
        WHERE trangthai='$trangthai';";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    $stt=$row['idsuco'];
    $tensuco=$row['tensuco'];
    $motasuco=$row['motasuco'];
    //Truy Van csdl Tai khoan
//    $sqluser="SELECT taikhoan.*, canbo.HOTENCB, stt.TrangThai FROM
//              taikhoan,canbo,stt
//              WHERE taikhoan.MACB=canbo.MACB
//              AND taikhoan.TRANGTHAI=stt.stt";
//    $queryuser=mysqli_query($conn,$sqluser);
//    $userList=mysqli_fetch_array($query);
	$con->close();
?>
<html>
	<head>
	    <style>
	        #hienthihinhanh img{
	            width:200px;
	            height:200px;
	        }
	          #hienthihinhanh {
	            position:absolute;
	            z-index:1;       
	  	        }
	
	    </style>
	</head>
	<body>
    	<table width=570px height="390"  border=1 align=center cellspacing=0 bordercolor=red bgcolor=#CCCCCC cellpading=0>  
    		<tr> 
    		    <td height="40px" align=center>
    		        <font size=5px color=red><b>Chào bạn <?php echo $taikhoan; ?>&#33;</b></font>
    		    </td>
    		</tr>
			<tr>
				<td>
					<h3>&nbsp;&nbsp;Danh sách sản phẩm của bạn là:
				    <input style="margin-left:30px" list="tensanpham" id="tencantim">
				    </h3>
				</td>
			</tr>
    		<tr>
				<td>
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Tài khoản</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($userList=mysqli_fetch_array($query)){

                      echo  '<tr class="odd gradeX" align="center">';
                      echo  '<td>'.$userList["idsuco"].'</td>';
                      echo  '<td>'.$userList["tensuco"].'</td>';
                      echo  '<td>'.$userList["motasuco"].'</td>';
                      echo  '<td>'.$userList["trangthai"].'</td>';
                      echo '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="del.php?id='.$userList["MATK"].'" onclick="return confirmAction()"> Delete</a>
                                <i class="fa fa-pencil fa-fw"></i> <a href="edituser.php?id='.$userList["MACB"].'">Edit</a></td>';
                       echo  '<td>'.$userList["NGAYTAO"].'</td>';
                        echo '</tr>';
                    }
                      ?>
                    </tbody>
                </table>
				</td>
			</tr> 
		</table>
		<div id="chitietsp"></div>
		<div id="hienthihinhanh"></div>
	</body>
</html>
