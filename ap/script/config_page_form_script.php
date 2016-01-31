<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
			//echo 'OK';
		$p_code = mysql_real_escape_string(htmlentities(input_validation($_POST['p_code'])));
		$page_name = mysql_real_escape_string(htmlentities(input_validation($_POST['page_name'])));
		$title = mysql_real_escape_string(htmlentities(input_validation($_POST['title'])));
		$keywords = mysql_real_escape_string(htmlentities(input_validation($_POST['keywords'])));		
		$page_desc = mysql_real_escape_string(htmlentities(input_validation($_POST['page_desc'])));		
		@$allow_log_value = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log_value'])));
		
		
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));	
		@$page_id = mysql_real_escape_string(htmlentities(input_validation($_POST['page_id'])));		
		
		if(!empty($page_name) && !empty($title) && !empty($p_code)){				
			
			if(empty($page_id)){				
				$insert = mysql_query("INSERT INTO page_setup VALUES ('','$p_code','$page_name','$title','$keywords','$page_desc', '$allow_log_value')");
				$last_insert_id = mysql_insert_id();
				if(!$insert){
					echo "Opps! Data not inserted./e";	
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'Page Information added for \''.display_page_name_from_page_id($con, $last_insert_id).'\'.';
						insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
					}
					
					echo "Data was inserted Successful!";
				}
			}else{
				$update = mysql_query("UPDATE page_setup SET p_code='$p_code', page_desc='$page_desc', page_name = '$page_name', 
										title = '$title', keywords='$keywords', allow_log='$allow_log_value' 
										WHERE page_id  = '$page_id'");
				if(!$update){
					echo "Opps! Data not updated./e";
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'Page Information edited for \''.display_page_name_from_page_id($con, $page_id).'\'.';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo "Data was update Successful!";
				}
			}
							
		}else {
			echo "Star mark field are required./e";
		}//end empty
	}//end isset
	
?>