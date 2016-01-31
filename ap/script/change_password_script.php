<?php
	require_once '../../core/init.php';
?>
<?php
//Data Saving Script
if(($_SERVER["REQUEST_METHOD"] == "POST")){
	//echo 'OK';

	$current_password = mysql_real_escape_string(htmlentities(input_validation($_POST['current_password'])));
	$current_password_md5 = md5($current_password);
	$password = mysql_real_escape_string(htmlentities(input_validation($_POST['password'])));
	$password_md5 = md5($password);
	$retype_password = mysql_real_escape_string(htmlentities(input_validation($_POST['retype_password'])));
	//$pin = mysql_real_escape_string(htmlentities(input_validation($_POST['pin'])));
	
	@$allow_log = mysql_real_escape_string(htmlentities(input_validation($_POST['allow_log'])));
	
	$user_id = (int)$_SESSION['user_id'];
	
	if( !empty($current_password) && !empty($password) && !empty($retype_password) ){
		
		if($current_password_md5 != $user_data['password']){
			echo "Your current password do not match./e";
		}elseif($password != $retype_password){
			echo "Your new password do not match with retype password./e";
		}else{
			
			if(change_password($con, $user_id, $password) === true){
				//for user log
				if($allow_log == 1){
					$remark = 'Password Changed.';
					insert_user_log($con, $_SESSION['user_id'], 7, REMOTE_IP, $remark );
				}
								
				echo "Password change Successful!";			
			}else{
				echo "Opps! Password not change./e";				
			}
		}				
	}else{
		echo "Star Mark field are required./e";	
	}//end empty	*/
}//end isset
	
?>