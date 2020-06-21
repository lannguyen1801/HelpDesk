<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 08-Nov-17
 * Time: 8:59 PM
 */


require 'connectiondb.php';
session_start();
include ('pketoan.php');
$thang=$_GET['thang'];
$nam=$_GET['nam'];
$sqlqurerydellluong="DELETE FROM `luongchitiet` WHERE 
        `Thang` = $thang AND `Nam` = $nam";
    if(mysqli_query($conn,$sqlqurerydellluong)){
        header('Location: ../KeToan/import.php');
    }
    
?>