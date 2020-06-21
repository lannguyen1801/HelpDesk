<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 06-Oct-17
 * Time: 7:14 PM
 */
require ('../../conn.php');
$id=$_GET['id'];
$delsqltk="DELETE FROM `suco` WHERE idsuco=$id;";
    if(mysqli_query($conn,$delsqltk)){
       echo "<script language='javascript'>
				alert('Thao tác thành công');
				
			</script>";
    }
    else{
        echo mysqli_error($conn); echo '</br>';
		header('Location: duyetsuco.php');
		echo "<script language='javascript'>
				alert('Thao tác thất bại');
			</script>"; 
	}
header('Location: duyetsuco.php');
?>
