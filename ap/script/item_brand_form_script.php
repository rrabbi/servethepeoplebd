<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
			//echo 'OK';
		$brand_name = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_name'])));
		$brand_details = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_details'])));
				
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));	
		@$brand_id = mysql_real_escape_string(htmlentities(input_validation($_POST['brand_id'])));
		
		$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["brand_img"]["name"])));
		//$new_img = md5(time()).'_'.$img;
		
		//query existing img
		$query = $con->prepare("SELECT brand_img FROM item_brand WHERE brand_id=:brand_id");
		$query->execute(array(':brand_id'=>$brand_id));
		$query = $query->fetch(PDO::FETCH_ASSOC);
		$exist_img = $query['brand_img'];
		
		///*
		$img_type = $_FILES["brand_img"]["type"];
		$img_size = $_FILES["brand_img"]["size"];
		$img_tmp = $_FILES["brand_img"]["tmp_name"];
		$tmp_size = filesize($_FILES["brand_img"]["tmp_name"]);				
		$img_error = $_FILES["brand_img"]["error"];
		define("MAX_SIZE", "1000");//Kb

		$allowedExt = array("png","jpeg","jpg","gif");
		//$extension = strtolower (substr ($img, strpos($img, '.') + 1)); // just show the file extension in lowercase
		$temp = explode(".", $_FILES["brand_img"]["name"]);
		$extension = end($temp);//$ext = getExtension($img);
		$extension = strtolower($extension);
		$array_match = in_array($extension, $allowedExt);
				
		//new image name 
		$new_img = md5(time().$img).'.'.$extension;
		
		if(empty($brand_name) === true){
			echo "Star mark field are required./e";
		}else{
			if(!empty($img)){ //Image Not Empty
				if((($extension != "gif")
					|| ($extension != "jpeg")
					|| ($extension != "jpg")
					|| ($extension != "png"))
					&& !$array_match){
					echo $extension." - is not support for upload./e";
				}elseif($tmp_size >(MAX_SIZE*1024)){
					echo number_format(($img_size/1024),2)."Kb, is Big size file, Not upload./e";
				}else{
					if(empty($brand_id) === true){
						if( check_single_data_availibility($con, 'item_brand', 'brand_name', $brand_name) === true){
							echo "'".$brand_name."' already exist./e";
						}else{				
							$insert = mysql_query("INSERT INTO item_brand VALUES ('','$brand_name','$brand_details','$new_img')");
							if(!$insert){
								echo "Opps! Data not inserted./e";	
							}else{
								upload_img(@$img_tmp, '../../files/brand/'.$exist_img, '../../files/brand/'.$new_img); //upload Images
								//for user log;
								if($allow_log == 1){
									$remark = 'New brand name added.';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
								
								echo "Data was inserted Successful!";
							}
						}
					}else{
						$update = mysql_query("UPDATE item_brand SET brand_name='$brand_name', brand_details='$brand_details',
												brand_img = '$new_img' WHERE brand_id  = '$brand_id'");
						if(!$update){
							echo "Opps! Data not updated./e";
						}else{
							upload_img(@$img_tmp, '../../files/brand/'.$exist_img, '../../files/brand/'.$new_img); //upload Images
							
							//for user log;
							if($allow_log == 1){
								$remark = 'Brand name edited.';
								insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
							}
							
							echo "Data was update Successful!";
						}
					}
				}//img extention check
			}elseif(empty($img)){ //Image Empty
				if(empty($brand_id) === true){
						if( check_single_data_availibility($con, 'item_brand', 'brand_name', $brand_name) === true){
							echo "'".$brand_name."' already exist./e";
						}else{				
							$insert = mysql_query("INSERT INTO item_brand VALUES ('','$brand_name','$brand_details','$new_img')");
							if(!$insert){
								echo "Opps! Data not inserted./e";	
							}else{
								//for user log;
								if($allow_log == 1){
									$remark = 'New brand name added.';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
								
								echo "Data was inserted Successful!";
							}
						}
					}else{
						$update = mysql_query("UPDATE item_brand SET brand_name='$brand_name', brand_details='$brand_details',
												brand_img = '$exist_img' WHERE brand_id  = '$brand_id'");
						if(!$update){
							echo "Opps! Data not updated./e";
						}else{							
							//for user log;
							if($allow_log == 1){
								$remark = 'Brand name edited.';
								insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
							}
							
							echo "Data was update Successful!";
						}
					}
			}
		}//end empty
	}//end isset
	
?>