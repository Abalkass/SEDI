<?php

	require_once('config.sedi.php');
	$controller = 'enseignement';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerEnseignement.php';

?>
