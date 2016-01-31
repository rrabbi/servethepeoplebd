<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["slider_i_img"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){				
	//echo 'OK';
	$date = TODAY_DATE;
	$item_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['item_type_id'])));
	$i_code = mysql_real_escape_string(htmlentities(input_validation($_POST['i_code'])));
	$i_name = mysql_real_escape_string(input_validation($_POST['i_name']));
	$i_details = mysql_real_escape_string($_POST['i_details']);
	@$i_available = mysql_real_escape_string(htmlentities(input_validation($_POST['i_available'])));
	$i_price = mysql_real_escape_string(htmlentities(input_validation($_POST['i_price'])));
	$i_quantity = mysql_real_escape_string(htmlentities(input_validation($_POST['i_quantity'])));
	
	@$i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_cat_id'])));
	@$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_sub_cat_id'])));	
	@$brand_id = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_id'])));
	@$i_user_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_user_type_id'])));	
		
	//$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["i_img"]["name"])));	
	
	@$item_id = mysql_real_escape_string(htmlentities(input_validation($_POST['item_id'])));
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
	
	//array values for item attributes
	@$i_attrib_id = $_POST['i_attrib_id']; //array
	@$attribe_value = $_POST['attribe_value']; //array
	@$attribe_sirial = $_POST['attribe_sirial']; //array
	
	$preg_code = preg_match("/^[I0-9]*$/", $i_code);
	//$preg_i_name = preg_match("/^[-a-zA-Z0-9 &@#\/%?=_:,.;'()]*$/", $i_name);
	//$preg_i_details = preg_match("/^[-a-zA-Z0-9 &@#\/%?=_:,.;'()]*$/", $i_details);
		
	//Empty check usng array
	$required_fields = array('item_type_id','i_code','i_name','i_available','i_cat_id','i_sub_cat_id');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			echo  'Fields marked with an asterisk are required./e';
			$error = 1; //for check
			break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
		}
	}
	
	if(empty($error) === true){			
		if(!$preg_code){
			echo "Opps! Something was wrong with Item code";
		}else{			
			if(empty($item_id)){
				$insert = mysql_query("INSERT INTO item_mst VALUES('','$item_type_id','$i_code','$i_name','$i_details',
											'$i_available','$i_price','$i_quantity','$brand_id','$i_user_type_id','',NOW(),'')");						
				if(!$insert){
					echo "Opps! Data not Save, Somthing wrong for insert item info./e";
				}else{
					$last_insert_id = mysql_insert_id();
					$_SESSION['session_item_id'] = $last_insert_id; //for images upload
					if(!empty($last_insert_id)){
						$j_item_sub_cat = mysql_query("INSERT INTO j_item_sub_cat VALUES ('$last_insert_id','$i_sub_cat_id')");
							if(!$j_item_sub_cat){echo "Opps! Somthing wrong for join Item and Sub Category./e";}								
							
						for($i=0; $i<count($i_attrib_id); $i++){
							 //echo $i_attrib_id[$i].'-'.$attribe_value[$i].' ';
							 $join_item_attrib_attribe_value = mysql_query("INSERT INTO j_item_attrib_value VALUES('$last_insert_id','$i_attrib_id[$i]','$attribe_value[$i]','$attribe_sirial[$i]')");
							if(!$join_item_attrib_attribe_value){echo "Opps! Somthing wrong for join Item and attribute value./e";}
						}
						
						//for user log;
						if($allow_log == 1){
							$remark = 'New item added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
														
						echo "Data was inserted Successful!";
					}else{
						echo "Opps! Data not inserted./e";	
					}//end last insert id check
				}//end item insert check						
			}else{//if item_id not empty				
				$update_item = mysql_query("UPDATE item_mst SET
										item_type_id='$item_type_id', i_name ='$i_name', i_details ='$i_details', i_available='$i_available', i_price='$i_price', 
										i_quantity='$i_quantity', brand_id ='$brand_id', i_user_type_id='$i_user_type_id', mdate=NOW() 
										WHERE item_id = '$item_id'");
				if(!$update_item){
					echo "Opps! Data not updated, Somthing wrong for updating item info./e";
				}else{
					$update_j_item_sub_cat = mysql_query("UPDATE j_item_sub_cat SET
										i_sub_cat_id = '$i_sub_cat_id' WHERE item_id = '$item_id'");
					if(!$update_j_item_sub_cat){echo "Opps! Somthing wrong with updating Sub-category./e";}
						
					$delete_j_item_attrib_value = mysql_query("DELETE FROM j_item_attrib_value WHERE item_id = '$item_id'");
					if(!$delete_j_item_attrib_value){
						echo 'Opps! Problem with deleting item attribute./e';
					}else{
						for($i=0; $i<count($i_attrib_id); $i++){
							//echo $i_attrib_id[$i].'-'.$attribe_value[$i].' ';
							$join_item_attrib_attribe_value = mysql_query("INSERT INTO j_item_attrib_value VALUES('$item_id','$i_attrib_id[$i]','$attribe_value[$i]','$attribe_sirial[$i]')");
							if(!$join_item_attrib_attribe_value){echo "Opps! Somthing wrong for join Item and attribute value./e";}
						}
						
						//for user log;
						if($allow_log == 1){
							$remark = 'Item Update';
							insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
						}
						
						echo "Data was updated Successful!";
					}
				}		
			}//end second item_id check
			
		}//end preg check
	}//end empty check */	
}

?>