<?php
if (isset($_SESSION['id'])== false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: ../Login.php');
	}
  else if(isset($_SESSION['level']))
  {
		$role=$_SESSION['level'];
      if( $role!=3 AND $role!=4  ){
				header('Location: ../Admin/Errorpage.php');
      }
  }
  ?>
