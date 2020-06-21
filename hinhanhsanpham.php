<?php
	session_start();
	$idsp= $_GET['idsp'];

	$con = new mysqli("localhost","id7072319_buoi3","buoi3","id7072319_buoi3");
    
	$sql="SELECT * FROM sanpham WHERE idsp=$idsp";
	$kq=$con->query($sql);
	$row= $kq->fetch_assoc();
	$hinhanhsp = $row['hinhanhsp'];
	$tensp = $row['tensp'];
	$giasp = $row['giasp'];
	$chitietsp  = $row['chitietsp'];
	
	
	?>
	
<html >
    
    <head>
        <body>
            <img class="animation1" src="<?php echo $hinhanhsp ?> "/>
        </body>
    </head>
</html>