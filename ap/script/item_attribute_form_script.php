<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$attribute_name = mysql_real_escape_string(htmlentities(input_validation($_POST['attribute_name'])));
		@$i_attrib_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_attrib_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($attribute_name)){
				$preg_attribute_name = preg_match("/^[a-zA-Z 0-9.',-]*$/", $attribute_name);
			if(!$preg_attribute_name){
				echo "Opps! Something was wrong with Attribute name./e";				
			}else{
				if(empty($i_attrib_id)){				
					$insert_query = mysql_query("INSERT INTO item_attribute VALUES ('','$attribute_name')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New item attribute added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE item_attribute SET attribute_name = '$attribute_name' WHERE i_attrib_id = '$i_attrib_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Item attribute updated';
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