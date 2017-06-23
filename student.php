<?php

	require_once('config.sedi.php');
	$controller = 'student';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerStudent.php';

?>
