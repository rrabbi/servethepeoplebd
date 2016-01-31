<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
			//echo 'OK';
		$asso_partner_name = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_partner_name'])));
		$asso_partner_details = $_POST['asso_partner_details'];
		$asso_partner_contact = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_partner_contact'])));
		$asso_partner_url = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_partner_url'])));
		@$asso_partner_status = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_partner_status'])));
		
		@$associate_type_id = mysql_real_escape_string(htmlentities(input_validation($_POST['associate_type_id'])));				
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));	
		@$asso_partner_id = mysql_real_escape_string(htmlentities(input_validation($_POST['asso_partner_id'])));
		
		$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["asso_partner_img"]["name"])));
		//$new_img = md5(time()).'_'.$img;
		
		//query existing img
		$query = $con->prepare("SELECT asso_partner_img FROM associate_partner WHERE asso_partner_id=:asso_partner_id");
		$query->execute(array(':asso_partner_id'=>$asso_partner_id));
		$query = $query->fetch(PDO::FETCH_ASSOC);
		$exist_img = $query['asso_partner_img'];
		
		///*
		$img_type = $_FILES["asso_partner_img"]["type"];
		$img_size = $_FILES["asso_partner_img"]["size"];
		$img_tmp = $_FILES["asso_partner_img"]["tmp_name"];
		$tmp_size = filesize($_FILES["asso_partner_img"]["tmp_name"]);				
		$img_error = $_FILES["asso_partner_img"]["error"];
		define("MAX_SIZE", "1000");//Kb

		$allowedExt = array("png","jpeg","jpg","gif");
		//$extension = strtolower (substr ($img, strpos($img, '.') + 1)); // just show the file extension in lowercase
		$temp = explode(".", $_FILES["asso_partner_img"]["name"]);
		$extension = end($temp);//$ext = getExtension($img);
		$extension = strtolower($extension);
		$array_match = in_array($extension, $allowedExt);
				
		//new image name
		if(!empty($img)){ 
			$new_img = md5(time().$img).'.'.$extension;
		}else{
			$new_img = '';
		}
		
		if(empty($asso_partner_name) === true){
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
					if(empty($asso_partner_id) === true){
						if( check_single_data_availibility($con, 'associate_partner', 'asso_partner_name', $asso_partner_name) === true){
							echo "'".$asso_partner_name."' already exist./e";
						}else{				
							$insert = mysql_query("INSERT INTO associate_partner VALUES ('','$associate_type_id','$asso_partner_name','$asso_partner_details',
														'$asso_partner_contact','$asso_partner_url','$asso_partner_status','$new_img')");
							if(!$insert){
								echo "Opps! Data not inserted./e";	
							}else{
								upload_img(@$img_tmp, '../../files/associate_partner/'.$exist_img, '../../files/associate_partner/'.$new_img); //upload Images
								//for user log;
								if($allow_log == 1){
									$remark = 'New associate partner name added.';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
								
								echo "Data was inserted Successful!";
							}
						}
					}else{
						$update = mysql_query("UPDATE associate_partner SET associate_type_id='$associate_type_id', asso_partner_name='$asso_partner_name', 
												asso_partner_details='$asso_partner_details', asso_partner_contact='$asso_partner_contact',
												asso_partner_url='$asso_partner_url', asso_partner_status='$asso_partner_status', asso_partner_img = '$new_img' 
												WHERE asso_partner_id='$asso_partner_id'");
						if(!$update){
							echo "Opps! Data not updated./e";
						}else{
							upload_img(@$img_tmp, '../../files/associate_partner/'.$exist_img, '../../files/associate_partner/'.$new_img); //upload Images
							
							//for user log;
							if($allow_log == 1){
								$remark = 'Associate partner name update.';
								insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
							}
							
							echo "Data was update Successful!";
						}
					}
				}//img extention check
			}elseif(empty($img)){ //Image Empty
				if(empty($asso_partner_id) === true){
						if( check_single_data_availibility($con, 'associate_partner', 'asso_partner_name', $asso_partner_name) === true){
							echo "'".$asso_partner_name."' already exist./e";
						}else{				
							$insert = mysql_query("INSERT INTO associate_partner VALUES ('','$associate_type_id','$asso_partner_name','$asso_partner_details',
														'$asso_partner_contact','$asso_partner_url','$asso_partner_status','$new_img')");
							if(!$insert){
								echo "Opps! Data not inserted./e";	
							}else{
								//for user log;
								if($allow_log == 1){
									$remark = 'New associate_partner name added.';
									insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
								}
								
								echo "Data was inserted Successful!";
							}
						}
					}else{
						$update = mysql_query("UPDATE associate_partner SET associate_type_id='$associate_type_id', asso_partner_name='$asso_partner_name', 
												asso_partner_details='$asso_partner_details', asso_partner_contact='$asso_partner_contact',
												asso_partner_url='$asso_partner_url',asso_partner_status='$asso_partner_status',asso_partner_img = '$exist_img' 
												WHERE asso_partner_id  = '$asso_partner_id'");
						if(!$update){
							echo "Opps! Data not updated./e";
						}else{							
							//for user log;
							if($allow_log == 1){
								$remark = 'Associate partner name update.';
								insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
							}
							
							echo "Data was update Successful!";
						}
					}
			}
		}//end empty
	}//end isset
	
?>