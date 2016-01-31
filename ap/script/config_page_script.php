<?php
	if(isset($_GET['page_id'])){
		$page_id = mysql_real_escape_string(htmlentities(input_validation($_GET['page_id'])));
				
		$query = $con->prepare("SELECT * FROM page_setup WHERE page_id=:page_id");
		$query->execute(array(':page_id'=>$page_id));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
			$p_code = $result['p_code'];
			$page_name = $result['page_name'];
			$title = $result['title'];
			$keywords = $result['keywords'];
			$page_desc = $result['page_desc'];
			$allow_log_value = $result['allow_log'];
	}	
?>
