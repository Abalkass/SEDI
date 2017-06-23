<?php

	require_once('config.sedi.php');
	$controller = 'jury';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerJury.php';

?>
