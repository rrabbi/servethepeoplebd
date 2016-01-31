<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
	//echo 'OK';

	$email = mysql_real_escape_string(htmlentities(input_validation($_POST['email'])));
	$password = mysql_real_escape_string(htmlentities(input_validation($_POST['password'])));
	$retype_password = mysql_real_escape_string(htmlentities(input_validation($_POST['retype_password'])));
	//$pin = mysql_real_escape_string(htmlentities(input_validation($_POST['pin'])));
	
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
	@$send_email = mysql_real_escape_string(htmlentities(input_validation($_POST['send_email'])));
	
	if( !empty($email) && !empty($password) && !empty($retype_password) ){
		
		if(user_exists_reg($con, $email) === false){
			echo "Oppos, the email you entered that was not register in our system./e";
		}elseif($password != $retype_password){
			echo "Your new password do not match with retype password./e";
		}else{
			$user_id = get_user_id_from_email($con, $email);
			//$full_name = get_full_name_from_username($con, $username);
			//$email = get_email_from_username($con, $username);
						
			if(change_password($con, $user_id, $password) === true){
				if($send_email == 1){
					email($email, 'Your password for '.COMPANY_NAME.' system login', "Hello User,\n\nYour email is: ".$email."\nYour new password is: |".$password."| \nPlease change your password at first login. \n\nBest Regards\n '.COMPANY_NAME.'");    
				}
				//for user log;	
				if($allow_log == 1){		
					$remark = 'Password Reset for user \''.display_email_from_user_id($con, $user_id).'\'.';
					insert_user_log($con, $_SESSION['user_id'], 8, REMOTE_IP, $remark );
				}
				echo "Password change Successful for the user ' ".$email." '.";											
			}else{
				echo "Opps! Password not change./e";				
			}
		}				
	}else{
		echo "Star Mark field are required./e";	
	}//end empty	*/
}//end isset
	
?>