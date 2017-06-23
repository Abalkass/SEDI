<?php

	require_once('config.sedi.php');
	$controller = 'IndexConnecte';

	if (isset($_GET['action']))
		$action = $_GET['action'];
	include CTR_PATH.'ControllerIndexConnecte.php';

?>
