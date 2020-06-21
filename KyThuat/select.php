<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
	$id=$_POST["employee_id"];
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "helpdesk1");
 $query = "SELECT * FROM giaiquyet,trangthaicv WHERE idgq =$id and giaiquyet.trangthai=trangthaicv.id";
	mysqli_set_charset($connect, 'UTF8');
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>ID</label></td>  
            <td width="70%">'.$row["idgq"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Công việc</label></td>  
            <td width="70%">'.$row["congviec"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Trạng thái</label></td>  
            <td width="70%">'.$row["trangthai"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Thời gian dự kiến hoàn thành</label></td>  
            <td width="70%">'.$row["thoigian"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>