<?php
	require_once '../../core/init.php';
?>
<?php

//code generate for INCOME (Only for admin)
if(isset($_POST['art_cat_id'])){
	//echo 'Ok';
	$art_cat_id = mysql_real_escape_string(htmlentities($_POST['art_cat_id']));
	
	if(!empty($art_cat_id)){
		$ac_code = mysql_fetch_array(mysql_query("SELECT ac_code FROM article_category WHERE art_cat_id='$art_cat_id'"));
		//echo $ac_code[0];
		$max_id = mysql_fetch_array(mysql_query("SELECT MAX(article_id) FROM article_mst WHERE art_cat_id='$art_cat_id'"));
		//echo $max_id[0];
		$last_code_no =mysql_fetch_array(mysql_query("SELECT a_code FROM article_mst WHERE article_id = '$max_id[0]' && art_cat_id='$art_cat_id'"));
		//echo $last_code_no[0];
		$code_array = preg_split('/(?<=\d)(?=[A-Z])|(?<=[A-Z])(?=\d)/i', $last_code_no[0]);
		$char_part = $code_array[0];
		@$num_part = $code_array[1];
		$new_num = $num_part + 1;
		if (strlen($new_num) == 1){
			//$new_code = $char_part.'00'.$new_num; //first time generate 001 number
			echo $new_code = $ac_code[0].'00'.$new_num; //first time generate 001 number
		}elseif(strlen($new_num) == 2){
			echo $new_code = $ac_code[0].'0'.$new_num;
		}elseif(strlen($new_num) >= 3){
			echo $new_code = $ac_code[0].$new_num;
		}//*/
	}//
	
}
?>