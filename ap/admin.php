<?php 
	require_once '../core/init.php';
	
	$auth_value = array('AdminDashboard');
	$auth_type = htmlentities(input_validation($_GET['type']));
	
	if( isset($_GET['type']) === true && $auth_type == 'AdminDashboard' ){
		require_once 'AuthAdmin/admin.php';               
	}
	/*elseif( isset($_GET['type']) === true && $auth_type == 'User'){
		require_once 'auth_user/user.php'; 
	}*/
	elseif(isset($_GET['type']) === true && !in_array($auth_type, $auth_value)){
		//session_start();
		//define("HOST_NAME", $_SERVER['SERVER_NAME']);
		//header('Location: http://'.HOST_NAME.'/index.php');
		//header('Location: '.AUTH_PAGE.'?type=not_found');
		header('Location: '.NOT_FOUND_PAGE);		
	}else{
		header('Location: http://'.HOST_NAME.'/index.php');
	}
?>           