<?php
	require_once '../core/init.php'; //for direct link 
	//require_once '../core/init.php'; //for redirect from admin page
?>
<?php

	//if(!empty ($_SESSION['user_id'])){
	if(logged_in() === true){
		
		//remove cookies
		if(isset($_SESSION['user_id'])){
			unset_remember_me_cookie($con, $_SESSION['user_id']);
		}
		
		/*//remove online user
		remove_online_user($con, $_SESSION['user_id']);*/
		
		//for Logout user log;
		$remark = 'Logout successfull.';
		insert_user_log($con, $_SESSION['user_id'], 2, REMOTE_IP, $remark );
		
				
		session_destroy();		
		header ('Location: '.HOME_PAGE);
	}else{
		header ('Location: '.HOME_PAGE);
	}
?>