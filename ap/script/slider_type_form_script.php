<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$st_name = mysql_real_escape_string(htmlentities(input_validation($_POST['st_name'])));
		$st_code = mysql_real_escape_string(htmlentities(input_validation($_POST['st_code'])));
		@$slider_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['slider_type_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($st_name) && !empty($st_code)){
				$preg_st_name = preg_match("/^[a-zA-Z 0-9.',-]*$/", $st_name);
			if(!$preg_st_name){
				echo "Opps! Something was wrong with Award type value./e";				
			}else{
				if(empty($slider_type_id)){				
					$insert_query = mysql_query("INSERT INTO slider_type VALUES ('','$st_name', '$st_code')");
					if(!$insert_query){
						echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New slider type added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE slider_type SET st_name = '$st_name', st_code='$st_code' WHERE slider_type_id = '$slider_type_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Slider type updated';
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