<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		@$item_type = mysql_real_escape_string(htmlentities(input_validation($_POST['item_type'])));
		@$item_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['item_type_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($item_type)){
				$preg_item_type = preg_match("/^[a-zA-Z 0-9.',-]*$/", $item_type);
			if(!$preg_item_type){
				echo "Opps! Something was wrong with item type./e";				
			}else{
				if(empty($item_type_id)){				
					$insert_query = mysql_query("INSERT INTO item_type_mst VALUES ('','$item_type')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New item type added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE item_type_mst SET item_type = '$item_type' WHERE item_type_id = '$item_type_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Item type updated';
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