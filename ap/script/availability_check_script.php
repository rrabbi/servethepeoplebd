<?php
	require_once '../../core/init.php';
?>
<?php
//check for username availability
	/*if(isset($_POST['data'])){
		$username = mysql_real_escape_string(htmlentities(input_validation($_POST['data'])));	
		
		if(!empty($username)){
			if(user_exists_reg($con, $username) === true){
				echo 'Opps, the username \''.$username.'\' is already exist.';
			}
		}
	}*/
//check for email availability	
	if(isset($_POST['data'])){
		$email = mysql_real_escape_string(htmlentities(input_validation($_POST['data'])));
		
		if(!empty($email)){
			if(email_exists($con, $email) === true){
				echo 'Opps, the email \''.$email.'\' is already exist.';
			}
		}
	}




?>