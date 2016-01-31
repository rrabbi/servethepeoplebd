<?php
	require_once '../../core/init.php';
?>
<?php
//User Registration Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		//echo 'OK';
		$user_id = mysql_real_escape_string(htmlentities(input_validation($_POST['user_id'])));
		$user_name = mysql_real_escape_string(htmlentities(input_validation($_POST['user_name'])));
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));		
		$dob = mysql_real_escape_string(htmlentities(input_validation($_POST['dob'])));
		$dob = date('Y-m-d',strtotime($dob));
		$user_contact = mysql_real_escape_string(htmlentities(input_validation($_POST['user_contact'])));
		$user_address = mysql_real_escape_string(htmlentities(input_validation($_POST['user_address'])));
		$user_desc = mysql_real_escape_string(htmlentities(input_validation($_POST['user_desc'])));	
			
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		@$send_email = mysql_real_escape_string(htmlentities(input_validation($_POST['send_email'])));
		
		//$user_img = mysql_real_escape_string(htmlentities(input_validation($_POST['user_img'])));
		$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["user_img"]["name"])));
		//$new_img = md5(time().$img); //generate unique name converting timestam into md5 hash
		
		//query existing img
		$query = $con->prepare("SELECT user_img FROM user_dtl WHERE user_id=:user_id");
		$query->execute(array(':user_id'=>$user_id));
		$query = $query->fetch(PDO::FETCH_ASSOC);
		$exist_img = $query['user_img'];
		
		///*
		$img_type = $_FILES["user_img"]["type"];
		$img_size = $_FILES["user_img"]["size"];
		$img_tmp = $_FILES["user_img"]["tmp_name"];
		$tmp_size = filesize($_FILES["user_img"]["tmp_name"]);				
		$img_error = $_FILES["user_img"]["error"];
		define("MAX_SIZE", "1000");//Kb

		$allowedExt = array("png","jpeg","jpg","gif");
		//$extension = strtolower (substr ($img, strpos($img, '.') + 1)); // just show the file extension in lowercase
		$temp = explode(".", $_FILES["user_img"]["name"]);
		$extension = end($temp);//$ext = getExtension($img);
		$extension = strtolower($extension);
		$array_match = in_array($extension, $allowedExt);
		
		//new image name 
		$new_img = md5(time().$img).'.'.$extension;
		
		//Empty check usng array
		$required_fields = array('user_name');
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				echo  'Fields marked with an asterisk are required./e';
				$error = 1; //for check
				break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
			}
		}
		
		if(empty($error) === true){
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
					$edit_admin_user = edit_admin_user($con, $user_id, $user_name, $dob, $user_contact, $user_address, $user_desc, $new_img);
					if($edit_admin_user === true){
						if($send_email == 1){
							email($email, 'Your profile edit have been successfull. ', "Hello ".$user_name.",\n\nYour profile Updated. \n\nBest Regards\n Tiger Talents Ltd.");    
						}
						
						upload_img(@$img_tmp, '../../files/profile/'.$exist_img, '../../files/profile/'.$new_img); //upload Images
						
						//for user log;
						if($allow_log == 1){
							$remark = 'User Profile updated for '.$email.'.';
							insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
						}
						
						echo 'User Successfully updated in our system.';
					}else{
						echo  'Oppos, Somthing was worng, please try again./e';
					}//
					
				}					
			}elseif(empty($img)){ //Image Empty
				$edit_admin_user = edit_admin_user($con, $user_id, $user_name, $dob, $user_contact, $user_address, $user_desc, $exist_img);
				
				if($edit_admin_user === true){
					if($send_email == 1){
						email($email, 'Your profile edit have been successfull. ', "Hello ".$user_name.",\n\nYour profile Updated. \n\nBest Regards\n Tiger Talents Ltd.");     
					}
					
					//for user log;
					if($allow_log == 1){
						$remark = 'User Profile updated for '.$email.'.';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo 'User Successfully updated in our system.';
				}else{
					echo  'Oppos, Somthing was worng, please try again./e';
				}//					
			}					

		}//end empty error check */				
	}//end isset
?>