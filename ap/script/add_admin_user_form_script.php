<?php
	require_once '../../core/init.php';
?>
<?php
//User Registration Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		//echo 'OK';
		@$role = 1; //Only for admin
		$user_name = mysql_real_escape_string(htmlentities(input_validation($_POST['user_name'])));
		$username = mysql_real_escape_string(htmlentities(input_validation($_POST['username'])));
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));
		$password = mysql_real_escape_string(htmlentities(input_validation($_POST['password'])));
		$password_again = mysql_real_escape_string(htmlentities(input_validation($_POST['password_again'])));		
		$dob = mysql_real_escape_string(htmlentities(input_validation($_POST['dob'])));
		$dob = date('Y-m-d',strtotime($dob));
		$user_contact = mysql_real_escape_string(htmlentities(input_validation($_POST['user_contact'])));
		$user_address = mysql_real_escape_string(htmlentities(input_validation($_POST['user_address'])));	
		$user_desc = mysql_real_escape_string(htmlentities(input_validation($_POST['user_desc'])));
		
		@$active = mysql_real_escape_string(htmlentities(input_validation($_POST['active'])));
		@$user_lock = mysql_real_escape_string(htmlentities(input_validation($_POST['user_lock'])));
		@$allow_email = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_email'])));
		@$tac = mysql_real_escape_string(htmlentities(input_validation($_POST['tac'])));		
		
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		@$send_email = mysql_real_escape_string(htmlentities(input_validation($_POST['send_email'])));
		
		//$user_img = mysql_real_escape_string(htmlentities(input_validation($_POST['user_img'])));
		$img = mysql_real_escape_string(htmlentities(strtolower($_FILES["user_img"]["name"])));
		//$new_img = md5(time()).'_'.$img; //generate unique name converting timestam into md5 hash
		
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
		$required_fields = array('user_name','password','password_again','username','email');
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				echo  'Fields marked with an asterisk are required./e';
				$error = 1; //for check
				break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
			}
		}
		
		if(empty($error) === true){
			if(username_exists_reg($con, $username) === true){
				echo  'Sorry, the username \''.$username.'\' is already in used./e';
			}elseif(email_exists($con, $email) === true){
				echo  'Sorry, the email \''.$email.'\' is already in used./e';
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
				echo  'A valid email addres is required./e';
			}elseif(strlen($password) < 6){
				echo  'Your password must be at last 6 characters./e';
			}elseif(strlen($password) >= 32){
				echo  'Your password must be between 6 to 32 characters./e';
			}elseif($password !== $password_again){
				echo  'Your password do not match./e';
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
						$add_user = add_admin_user($con, $username, $user_name, $email, $password, $dob, $role, $user_contact, $user_address, $user_desc, $new_img,
								 $active, $user_lock, $allow_email, $tac );
						if($add_user === true){
							if($send_email == 1){
								email($email, 'Your registration have been successfull. ', "Hello ".$user_name.",\n\nYour username is: ".$email."\nYour password is: |".$password."| \nPlease change your password at first login. \n\nBest Regards\n Tiger Talents Ltd.");    
							}
							
							upload_img(@$img_tmp, '', '../../files/profile/'.$new_img); //upload Images
							
							//for user log;
							if($allow_log == 1){
								$remark = 'New admin is created using this '.$email.'.';
								insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
							}
							
							echo 'User Successfully added in our system.';
						}else{
							echo  'Oppos, Somthing was worng, please try again./e';
						}//
						
					}					
				}elseif(empty($img)){ //Image Empty
					$add_user = add_admin_user($con, $username, $user_name, $email, $password, $dob, $role, $user_contact, $user_address, $user_desc, $img,
								 $active, $user_lock, $allow_email, $tac );
					if($add_user === true){
						if($send_email == 1){
							email($email, 'Your registration have been successfull. ', "Hello ".$user_name.",\n\nYour username is: ".$email."\nYour password is: |".$password."| \nPlease change your password at first login. \n\nBest Regards\n Tiger Talents Ltd.");    
						}
						//for user log;
						if($allow_log == 1){
							$remark = 'New admin is created using this '.$email.'.';
							insert_user_log($con, $_SESSION['user_id'], 4, REMOTE_IP, $remark );
						}
						
						echo 'User Successfully added in our system.';
					}else{
						echo  'Oppos, Somthing was worng, please try again./e';
					}//					
				}					
			}
		}//end empty error check */				
	}//end isset
?>