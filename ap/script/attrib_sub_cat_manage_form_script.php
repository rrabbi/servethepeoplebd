<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		//echo 'OK';		
		@$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_sub_cat_id'])));
		@$array_attrib_id = $_POST['array_attrib_id']; //print_r($array_attrib_id);//array value
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		
		if(!empty($i_sub_cat_id) && !empty($array_attrib_id)){
			
			//$delete_join = mysql_query("DELETE FROM j_sub_cat_attrib WHERE i_sub_cat_id = '$i_sub_cat_id'");
			//if(!$delete_join){
			//	echo 'Opps! join data not deleted./e';
			//}else{
				foreach($array_attrib_id AS $key=>$values){
					$join = mysql_query("INSERT INTO j_sub_cat_attrib VALUES('$i_sub_cat_id','$values')");				
				}
				if(!$join){
					echo "Opps! Data not Save, Somthing wrong./e";	
				}else{
					//for user log;
					if($allow_log == 1){
						$remark = 'Item attributes update for sub-category';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo "Data was update Successful!";
				}
			//}//end delete				

		}else{
			echo "Star Mark field are required./e";	
		}//end empty  */	
	}//end isset
	
?>