<?php

function KiemTraCB($id,$name,$dv,$email,$conn){
    $sql="SELECT * FROM canbo WHERE MACB='$id'";
    $resul=mysqli_query($conn,$sql);
    $numrow=mysqli_num_rows($resul);
    if($numrow==0){
        $sqlinsert="INSERT INTO canbo (MACB , HOTENCB, MADV, EMAIL) VALUES ('$id','$name','$dv','$email')";
        echo $sqlinsert;
        mysqli_query($conn,$sqlinsert);

    }
}
function KiemTraCoTonTaiBanLuong($Thang,$Nam,$conn){
    $sql="SELECT * FROM luongchitiet WHERE Thang='$Thang' AND Nam='$Nam'";
//    echo $sql;
    $resul=mysqli_query($conn,$sql);
    $numrow=mysqli_num_rows($resul);
    if($numrow==0){
        return 0;
    }else {
        return 1;
    }
}
?>