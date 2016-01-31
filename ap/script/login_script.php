<?php
	//require_once '../../core/init.php'; //not use for this action without jquery 
?>
<?php
// Login Script (function use from user.php)
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		$username = mysql_real_escape_string(htmlentities(input_validation($_POST['username'])));
		//@$pin = mysql_real_escape_string(htmlentities(input_validation($_POST['pin'])));
		$password = mysql_real_escape_string(htmlentities(input_validation($_POST['password'])));		
		$password_md5 = md5($password);
		
		@$remember_me = mysql_real_escape_string(htmlentities(input_validation($_POST['remember_me'])));
		
		if(!empty($username) && !empty($password) ){			
			if(user_exists($con, $username) === false){ //$con is PDO connection variable
				$errors[] = 'We can\'t find your Username';
			}elseif(user_active($con, $username, $password_md5) === false){
				//echo 'You haven\'t activated your account.';
				$errors[] = 'Your account isn\'t active. Please contact with administrator.';
			}elseif(user_lock($con, $username, $password_md5) === false){
				//echo 'You account is Locked, Please contact with admin.';
				$errors[] = 'You account is Locked, Please contact with administrator.';
			}else{
				$login = login($con, $username, $password_md5);
				
				if($login === false){ //if login return false
					//echo 'Your Username / Password combination is incorrect.';
					$errors[] = 'Your Username / Password combination is incorrect.';
				}else{				
					$_SESSION['user_id'] = $login;
					session_regenerate_id(); //creates a new unique-ID for to represent the current user’s session.
					
					//for login user log;
					$remark = 'Logged in successfull.';
					insert_user_log($con, $_SESSION['user_id'], 1, REMOTE_IP, $remark );
					
					//SetCookies
					if($remember_me == 1){
						set_remember_me_cookie($con, $username, $password);
					}
												
					login_role_base_redirect($con); //redirect	
					//echo $login;
				}
			}//empty check
		
		}else{	//echo "You need to enter a Username and Password.";
			$errors[] = 'You need to enter your Username and Password';
		}//empty check	
	}//end isset
	
