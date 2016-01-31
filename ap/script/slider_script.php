<?php
	if(isset($_GET['slider_id'])){ 
		$slider_id = $_GET['slider_id'];	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM slider WHERE slider_id = '$slider_id'"));
			$s_serial = $query['s_serial'];
			$s_title = $query['s_title'];
			$s_status = $query['s_status'];
			$file_name = $query['s_img1'];
			//$s_img2 = $query['s_img2'];
			//$s_text1 = $query['s_text1'];
			//$s_text2 = $query['s_text2'];
			
	}
?>