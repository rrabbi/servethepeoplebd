<?php 
//recover script for both Username And Password
	//$email = ''; //for declar global variable
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));
		$type = mysql_real_escape_string(htmlentities(input_validation($_GET['type'])));
		
		$type_allowed = array('ForgotPassword');
		if(isset($type)=== true && in_array($type, $type_allowed) === true ){
			if(empty($email) === true){
				$errors[] = 'You need to enter your email address which you have used for Signup';
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
				$errors[] = 'A valid email addres is required.';
			}if(email_exists($con, $email) === false){
				$errors[] = 'Oops, we can\'t recognize you. Please try again';				
			}else{				
				recover($con, $email, $type); // same function user for recover both Username And Password
								
				$_SESSION['recover_password_email'] = $email; //for success message check
				
				//for Logout user log;
				$remark = 'Recover login details.';
				insert_user_log($con, user_id_from_email($con, $email), 9, REMOTE_IP, $remark );
				
				if($_GET['type'] == 'ForgotPassword'){
					header('Location: auth.php?type=ForgotPassword&Success');
					exit();
				}
				
			}
		}//array check
			
	}//end isset
?>