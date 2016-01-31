<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$asso_name = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_name'])));
		@$associate_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['associate_type_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($asso_name)){
				$preg_asso_name = preg_match("/^[a-zA-Z 0-9.',-]*$/", $asso_name);
			if(!$preg_asso_name){
				echo "Opps! Something was wrong with associate type./e";				
			}else{
				if(empty($associate_type_id)){				
					$insert_query = mysql_query("INSERT INTO associate_type VALUES ('','$asso_name')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New item associate type added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE associate_type SET asso_name = '$asso_name' WHERE associate_type_id = '$associate_type_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Associate type updated';
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