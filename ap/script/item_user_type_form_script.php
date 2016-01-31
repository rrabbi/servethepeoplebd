<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		@$i_user_type = mysql_real_escape_string(htmlentities(input_validation($_POST['i_user_type'])));
		@$i_user_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_user_type_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($i_user_type)){
				$preg_i_user_type = preg_match("/^[a-zA-Z 0-9.',-]*$/", $i_user_type);
			if(!$preg_i_user_type){
				echo "Opps! Something was wrong with item uses type./e";				
			}else{
				if(empty($i_user_type_id)){				
					$insert_query = mysql_query("INSERT INTO item_user_type VALUES ('','$i_user_type')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New item user type added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE item_user_type SET i_user_type = '$i_user_type' WHERE i_user_type_id = '$i_user_type_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Item user type updated';
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