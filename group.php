<?php

	require_once('config.sedi.php');
	$controller = 'group';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerGroup.php';

?>
