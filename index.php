<?php

	require_once('config.sedi.php');
	$controller = 'User';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerUser.php';

?>
