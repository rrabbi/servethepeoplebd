<?php
	require_once '../../core/init.php';
?>
<?php
//if(($_SERVER["REQUEST_METHOD"] == "POST") || isset($_FILES["slider_i_img"]["name"])  ){	
if(($_SERVER["REQUEST_METHOD"] == "POST") ){				
	//echo 'OK';
	$date = TODAY_DATE;
	$i_code = mysql_real_escape_string(htmlentities(input_validation($_POST['i_code'])));
	$i_name = mysql_real_escape_string(input_validation($_POST['i_name']));
	$i_details = mysql_real_escape_string(htmlentities(input_validation($_POST['i_details'])));
	@$i_available = mysql_real_escape_string(htmlentities(input_validation($_POST['i_available'])));
	$i_price = mysql_real_escape_string(htmlentities(input_validation($_POST['i_price'])));
	$i_quantity = mysql_real_escape_string(htmlentities(input_validation($_POST['i_quantity'])));
	
	@$i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_cat_id'])));
	@$i_sub_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_sub_cat_id'])));	
	@$brand_id = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_id'])));
	@$i_user_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_user_type_id'])));	
		
	$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["i_img"]["name"])));	
	
	@$item_id = mysql_real_escape_string(htmlentities(input_validation($_POST['item_id'])));
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
	
	//array values for item attributes
	@$i_attrib_id = $_POST['i_attrib_id']; //array
	@$attribe_value = $_POST['attribe_value']; //array
	@$attribe_sirial = $_POST['attribe_sirial']; //array
	
	//query existing img
	$query = $con->prepare("SELECT i_img FROM item_mst WHERE item_id=:item_id");
	$query->execute(array(':item_id'=>$item_id));
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$exist_img = $query['i_img'];	
		
	$preg_code = preg_match("/^[I0-9]*$/", $i_code);
	//$preg_i_name = preg_match("/^[-a-zA-Z0-9 &@#\/%?=_:,.;'()]*$/", $i_name);
	//$preg_i_details = preg_match("/^[-a-zA-Z0-9 &@#\/%?=_:,.;'()]*$/", $i_details);
	
	$img_type = $_FILES["i_img"]["type"];
	$img_size = $_FILES["i_img"]["size"];
	$img_tmp = $_FILES["i_img"]["tmp_name"];
	$tmp_size = filesize($_FILES["i_img"]["tmp_name"]);				
	$img_error = $_FILES["i_img"]["error"];
	define("MAX_SIZE", "1000");//Kb

	$allowedExt = array("png","jpeg","jpg","gif");				
	$temp = explode(".", $_FILES["i_img"]["name"]);
	$extension = end($temp);//$ext = getExtension($i_img);
	$extension = strtolower($extension);
	$array_match = in_array($extension, $allowedExt);
	
	//new image name 
	$new_img = md5(time().$img).'.'.$extension;
	
	//Empty check usng array
	$required_fields = array('i_code','i_name','i_available','i_cat_id','i_sub_cat_id');
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
			if(!empty($img)){
				if((($extension != "gif")
					|| ($extension != "jpeg")
					|| ($extension != "jpg")
					|| ($extension != "png"))
					&& !$array_match){
					echo $extension." - is not support for upload";
				}elseif($tmp_size >(MAX_SIZE*1024)){
					echo number_format(($img_size/1024),2)."Kb, is Big size file, Not upload";
				}else{  //unlink() file_exists()
					if(empty($item_id)){
						
						$insert = mysql_query("INSERT INTO item_mst VALUES('','$i_code','$i_name','$i_details',
												'$i_available','$i_price','$i_quantity','$brand_id','$i_user_type_id','$new_img',NOW(),'')");						
						if(!$insert){
							echo "Opps! Data not Save, Somthing wrong for insert item info./e";
						}else{
							$last_insert_id = mysql_insert_id();
							//$_SESSION['last_item_id'] = $last_insert_id; //for insert price details
							if(!empty($last_insert_id)){
								$j_item_sub_cat = mysql_query("INSERT INTO j_item_sub_cat VALUES ('$last_insert_id','$i_sub_cat_id')");
								if(!$j_item_sub_cat){echo "Opps! Somthing wrong for join Item and Sub Category.e";}								
								
								for($i=0; $i<count($i_attrib_id); $i++){
								 //echo $i_attrib_id[$i].'-'.$attribe_value[$i].' ';
								 $join_item_attrib_attribe_value = mysql_query("INSERT INTO j_item_attrib_value VALUES('$last_insert_id','$i_attrib_id[$i]','$attribe_value[$i]','$attribe_sirial[$i]')");
									if(!$join_item_attrib_attribe_value){echo "Opps! Somthing wrong for join Item and attribute value./e";}
								}
								
								upload_img(@$img_tmp, '../../files/items/'.$exist_img, '../../files/items/'.$new_img); //upload Images	
								
								//for user log;
								if($allow_log == 1){
									$remark = 'New item added';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
																
								echo "Data was inserted Successful!";
							}else{
								echo "Opps! Data not inserted";	
							}//end last insert id check
						}//end item insert check											
					}else{//if item_id not empty						
						
						$update_item = mysql_query("UPDATE item_mst SET
											i_name ='$i_name', i_details ='$i_details', i_available='$i_available', i_price='$i_price', i_quantity='$i_quantity',
											brand_id ='$brand_id', i_user_type_id='$i_user_type_id', i_img='$new_img', mdate=NOW() WHERE item_id = '$item_id'");
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
								
								upload_img(@$img_tmp, '../../files/items/'.$exist_img, '../../files/items/'.$new_img); //upload Images	
								
								//for user log;
								if($allow_log == 1){
									$remark = 'Item Update';
									insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
								}
									
								echo "Data was updated Successful!";
							}
						}						
					}//end first item_id check
				}//end extention check
			/*###########################################*/
			}elseif(empty($img)){
				if(empty($item_id)){
					$insert = mysql_query("INSERT INTO item_mst VALUES('','$i_code','$i_name','$i_details',
												'$i_available','$i_price','$i_quantity','$brand_id','$i_user_type_id','$img',NOW(),'')");						
					if(!$insert){
						echo "Opps! Data not Save, Somthing wrong for insert item info./e";
					}else{
						$last_insert_id = mysql_insert_id();
						//$_SESSION['last_item_id'] = $last_insert_id; //for insert price details
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
											i_name ='$i_name', i_details ='$i_details', i_available='$i_available', i_price='$i_price', i_quantity='$i_quantity',
											brand_id ='$brand_id', i_user_type_id='$i_user_type_id', i_img='$exist_img', mdate=NOW() WHERE item_id = '$item_id'");
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
			}//end i_img check
		}//end preg check
	}//end empty check */	
}

?>