<?php
	require_once '../../core/init.php';
?>
<?php
//User Registration Script
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		//echo 'OK';
		$user_id = mysql_real_escape_string(htmlentities(input_validation($_POST['user_id'])));
		//$name = mysql_real_escape_string(htmlentities(input_validation($_POST['name'])));		
		//$username = mysql_real_escape_string(htmlentities(input_validation($_POST['username'])));		
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));		
		//$dob = mysql_real_escape_string(htmlentities(input_validation($_POST['dob'])));
		//$dob = date('Y-m-d',strtotime($dob));
		//$role = mysql_real_escape_string(htmlentities(input_validation($_POST['role'])));
		
		@$active = mysql_real_escape_string(htmlentities(input_validation($_POST['active'])));
		@$user_lock = mysql_real_escape_string(htmlentities(input_validation($_POST['user_lock'])));
		@$allow_email = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_email'])));
		@$tac = mysql_real_escape_string(htmlentities(input_validation($_POST['tac'])));		
		
		@$send_email = mysql_real_escape_string(htmlentities(input_validation($_POST['send_email'])));
		@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
		
		//Empty check usng array
		$required_fields = array('user_id','email');
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				echo  'Fields marked with an asterisk are required./e';
				$error = 1; //for check
				break 1; //there are multiple fields, if get any fields error than breck the loop, otherwise loop will continue for all fields error
			}
		}
		
		if(empty($error) === true){
				//echo  'OK.';
				$edit_user = edit_user($con, $user_id, $email, $active, $user_lock, $allow_email, $tac );
				
				if($edit_user === true){
					if($send_email == 1){
						email($email, 'Your profile edit have been successfull. ', "Hello User,\n\nYour Email is: ".$email."\n\nPlease login and check out your details. \n\nBest Regards\n '.COMPANY_NAME.'");    
					}
					
					//for user log;
					if($allow_log == 1){			
						$remark = 'Information edit for user \''.display_email_from_user_id($con, $user_id).'\'.';
						insert_user_log($con, $_SESSION['user_id'], 5, REMOTE_IP, $remark );
					}
					
					echo 'User edit Successfully.';
				}else{
					echo  'Oppos, Somthing was worng, please try again./e';
				}//*/	
		}//end empty error check	*/			
	}//end isset
?>