<?php 

	session_start();
	
	// Development
	error_reporting(E_ALL);
	
	define('BASE_PATH', __DIR__);
	define('APP', BASE_PATH.DIRECTORY_SEPARATOR.'Application');
	define('SYS', BASE_PATH.DIRECTORY_SEPARATOR.'Moongrace');
	define('EXT', '.php');
	define('DEFAULT_CONTROLLER', 'Welcome');
	define('MG_VERSION', '1.04 ALPHA');

	require(SYS.DIRECTORY_SEPARATOR.'boot'.EXT);
	
?>
