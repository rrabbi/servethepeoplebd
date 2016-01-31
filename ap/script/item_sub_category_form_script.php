<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$sub_category = mysql_real_escape_string(input_validation($_POST['sub_category']));
		@$i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_cat_id'])));
		
		@$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_sub_cat_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($sub_category) && !empty($i_cat_id)){
			if(empty($i_sub_cat_id)){				
				$insert_query = mysql_query("INSERT INTO item_sub_category VALUES ('','$i_cat_id','$sub_category')");
				if(!$insert_query){
				echo "Opps! Data not inserted./e";	
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'New item Sub-category added';
						insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
					}
					
					echo "Data was inserted Successful!";
				}
			}else{
				$update_query = mysql_query("UPDATE item_sub_category SET sub_category='$sub_category', i_cat_id='$i_cat_id' WHERE i_sub_cat_id = '$i_sub_cat_id'");
				if(!$update_query){
					echo "Opps! Data not updated./e";
				}else{						
					//for user log;
					if($allow_log == 1){
						$remark = 'Item Sub-category updated';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo "Data was update Successful!";
				}
			}
		}else {
			echo "Star mark field are required./e";
		}//end empty  */	
	}//end isset
	
?>