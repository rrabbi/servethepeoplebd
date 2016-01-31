<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$i_cat_name = mysql_real_escape_string(input_validation($_POST['i_cat_name']));
		@$i_cat_id = mysql_real_escape_string(htmlentities(input_validation($_POST['i_cat_id'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["i_cat_img"]["name"])));
		
		//query existing img
		$query = $con->prepare("SELECT i_cat_img FROM item_category WHERE i_cat_id=:i_cat_id");
		$query->execute(array(':i_cat_id'=>$i_cat_id));
		$query = $query->fetch(PDO::FETCH_ASSOC);
		$exist_img = $query['i_cat_img'];			
		
		//if( !empty($s_title) && !empty($s_serial) ){
				
		$img_type = $_FILES["i_cat_img"]["type"];
		$img_size = $_FILES["i_cat_img"]["size"];
		$img_tmp = $_FILES["i_cat_img"]["tmp_name"];
		$tmp_size = filesize($_FILES["i_cat_img"]["tmp_name"]);				
		$img_error = $_FILES["i_cat_img"]["error"];
		define("MAX_SIZE", "1000");//Kb
	
		$allowedExt = array("png","jpeg","jpg","gif");
		//$extension = strtolower (substr ($i_cat_img, strpos($i_cat_img, '.') + 1)); // just show the file extension in lowercase
		$temp = explode(".", $_FILES["i_cat_img"]["name"]);
		$extension = end($temp);//$ext = getExtension($i_cat_img);
		$extension = strtolower($extension);
		$array_match = in_array($extension, $allowedExt);												
		
		//new image name 
		$new_img = md5(time().$img).'.'.$extension;
		
		//Empty check usng array
		$required_fields = array('i_cat_name');
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				echo  'Fields marked with an asterisk are required./e';
				$error = 1; //for check
				break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
			}
		}
		
		if(empty($error) === true){
			if(!empty($img)){ //img not empty
				if( !$array_match){
					echo $extension." - is not support for upload./e";
				}elseif($tmp_size >(MAX_SIZE*1024)){
					echo number_format(($tmp_size/1024),2)."Kb, is Big size file, Not upload./e";
				}else{
					if(empty($i_cat_id)){				
						$insert_query = mysql_query("INSERT INTO item_category VALUES ('','$i_cat_name','$new_img')");
						if(!$insert_query){
						echo "Opps! Data not inserted./e";	
						}else{
							upload_img(@$img_tmp, '../../files/items/'.$exist_img, '../../files/items/'.$new_img); //upload Images	
							
							//for user log;
							if($allow_log == 1){
								$remark = 'New item category added';
								insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
							}
							
							echo "Data was inserted Successful!";
						}
					}else{//id not empty
						$update_query = mysql_query("UPDATE item_category SET i_cat_name = '$i_cat_name', i_cat_img='$new_img'
													WHERE i_cat_id = '$i_cat_id'");
						if(!$update_query){
							echo "Opps! Data not updated./e";
						}else{
							upload_img(@$img_tmp, '../../files/items/'.$exist_img, '../../files/items/'.$new_img); //upload Images	
													
							//for user log;
							if($allow_log == 1){
								$remark = 'Item category updated';
								insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
							}
							
							echo "Data was update Successful!";
						}
					}					
				}//end img check
			}elseif(empty($img)){ //img empty
				if(empty($i_cat_id)){				
					$insert_query = mysql_query("INSERT INTO item_category VALUES ('','$i_cat_name','$img')");
					if(!$insert_query){
					echo "Opps! Data not inserted./e";	
					}else{
						//for user log;
						if($allow_log == 1){
							$remark = 'New item category added';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo "Data was inserted Successful!";
					}
				}else{
					$update_query = mysql_query("UPDATE item_category SET i_cat_name = '$i_cat_name', i_cat_img='$exist_img'
											WHERE i_cat_id = '$i_cat_id'");
					if(!$update_query){
						echo "Opps! Data not updated./e";
					}else{						
						//for user log;
						if($allow_log == 1){
							$remark = 'Item category updated';
							insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
						}
						
						echo "Data was update Successful!";
					}
				}
				
			}			
		}//empty error check
			
	}//end isset
	
?>