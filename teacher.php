<?php

	require_once('config.sedi.php');
	$controller = 'teacher';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerTeacher.php';

?>
