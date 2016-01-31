<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$ac_name = mysql_real_escape_string(htmlentities(input_validation($_POST['ac_name'])));
		$ac_code = mysql_real_escape_string(htmlentities(input_validation($_POST['ac_code'])));
		@$art_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['art_cat_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($ac_name) && !empty($ac_code)){
				$preg_ac_name = preg_match("/^[a-zA-Z 0-9.',-]*$/", $ac_name);
			if(!$preg_ac_name){
				echo "Opps! Something was wrong with Award type value./e";				
			}else{
				if(empty($art_cat_id)){				
					$insert_query = mysql_query("INSERT INTO article_category VALUES ('','$ac_name', '$ac_code')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New article category added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE article_category SET ac_name = '$ac_name', ac_code='$ac_code' WHERE art_cat_id = '$art_cat_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Article category updated';
							insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
						}
						
						echo "Data was update Successful!";
					}
				}
			}//end preg
		}else {
			echo "Star mark field are required./e";
		}//end empty  */	
	}//end isset
	
?>