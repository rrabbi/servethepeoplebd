<?php
	session_start();
	define("HOST_NAME", $_SERVER['SERVER_NAME']);
	header('Location: http://'.HOST_NAME.'/index.php');
?>