<?php  
//select.php  
if(isset($_POST["trangthai"]))
{
	$idtt=$_POST["trangthai"];
	$namesuco = $_POST["namesuco"];
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "helpdesk1");
 $query = "SELECT * FROM giaiquyet,trangthaicv WHERE idgq =$idtt and giaiquyet.trangthai=trangthaicv.id";
	mysqli_set_charset($connect, 'UTF8');
 $result = mysqli_query($connect, $query);
 $output .= '
      <div class="table-responsive" id="hienthi"> 
	  <form method="post">
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
		if($row['trangthai']=="Đã gửi"){
			$dem = "Đang xử lý";
		}else if($row['trangthai']=="Đang xử lý"){
			$dem = "Hoàn thành";
		}else $dem = "Hoàn thành";
     $output .= '
     <tr>  
            <td width="30%"><label>ID</label></td>  
            <td width="70%" >'.$row["idgq"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Công việc</label></td>  
            <td width="70%">'.$row["congviec"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Trạng thái</label></td>  
            <td width="70%" ><div id="kiemtra" name="'.$row["trangthai"].'">'.$row["trangthai"].'</div></td>  
        </tr>
        <tr>  
            <td width="30%"><label>Thời gian dự kiến hoàn thành</label></td>  
            <td width="70%">'.$row["thoigian"].'</td>  
        </tr>
		<tr>
			<td width="30%"><div id="div1" ><input type="button" name="'.$namesuco.'" id="'.$row["idgq"].'" class="btn btn-warning" value="'.$dem.'"/></div></td>
            <td></td> 
		</tr>
     ';
    }
    $output .= '</table></form></div>';
    echo $output;
	
}


?>

<script>
//	function hidden(){
//		var div1 = document.getElementById('div1');
//		var div2 = document.getElementById('div2');
//		var kiemtra = document.getElementById('kiemtra');
//		alert(kiemtra);
////		if(kiemtra.name=="Đã gửi"){
////			div1.style.display='block';
////			div2.style.display='none';
////		}
//	}
		$(document).on('click', '.btn-warning', function(){
		var idgq = $(this).attr("id");
		var valgq = $(this).attr("value");
		var name = $(this).attr("name");
//			alert(idgq);
				$.ajax({
			   url:"updatett.php",
			   method:"POST",
			   data:{idgq:idgq,valgq:valgq,name:name},
			   success:function(data){
				$('#hienthi').html(data);
				$('#trangthaiupdate').modal('show');
			   }
			  });
	});
</script>
