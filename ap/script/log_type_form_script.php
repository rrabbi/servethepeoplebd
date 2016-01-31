<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
			//echo 'OK';
		$log_type_name = mysql_real_escape_string(htmlentities(input_validation($_POST['log_type_name'])));		
		
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));	
		@$log_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['log_type_id'])));		
		
		if(empty($log_type_name) === true){
			echo "Star mark field are required./e";
		}else{
			
			if(empty($log_type_id) === true){
				if( check_single_data_availibility($con, 'log_type', 'log_type_name', $log_type_name) === true){
					echo "'".$log_type_name."' already exist./e";
				}else{
									
					$insert = mysql_query("INSERT INTO log_type VALUES ('','$log_type_name')");
					if(!$insert){
						echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New log type added.';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}				
			}else{
				$update = mysql_query("UPDATE log_type SET log_type_name='$log_type_name' 
										WHERE log_type_id  = '$log_type_id'");
				if(!$update){
					echo "Opps! Data not updated./e";
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'Log type edited.';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo "Data was update Successful!";
				}
			}
							
		}//end empty
	}//end isset
	
?>