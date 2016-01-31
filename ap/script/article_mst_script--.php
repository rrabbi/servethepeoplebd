<?php
	if(isset($_GET['article_id'])){ 
		$article_id = $_GET['article_id'];	
		$query = mysql_fetch_array(mysql_query("SELECT * FROM article WHERE article_id = '$article_id'"));
			$art_cat_id = $query['art_cat_id'];
			$a_code = $query['a_code'];
			$a_title = $query['a_title'];
			$a_desc = $query['a_desc'];
			$a_comment = $query['a_comment'];
			$a_status = $query['a_status'];
			$file_name = $query['a_img'];			
	}
?>