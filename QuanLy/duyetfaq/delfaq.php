<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 06-Oct-17
 * Time: 7:14 PM
 */
require ('../../conn.php');
$idfaq=$_GET['id'];
$delsqltk="DELETE FROM `faq` WHERE idfaq=$idfaq;";
    if(mysqli_query($conn,$delsqltk)){
       echo "<script language='javascript'>
				alert('Thao tác thành công');
				
			</script>";
    }
    else{
        echo mysqli_error($conn); echo '</br>';
		header('Location: duyetfaq.php');
		echo "<script language='javascript'>
				alert('Thao tác thất bại');
			</script>"; 
	}
header('Location: duyetfaq.php');
?>
