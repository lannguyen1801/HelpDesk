<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbnienluan";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    mysqli_set_charset($conn, 'UTF8');
    if(!$conn){
        die('Ket noi that bai:'.mysqli_connect_error());
    }
?>
