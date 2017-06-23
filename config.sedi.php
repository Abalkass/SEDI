<?php

// Définition des constante "magique" de PHP
define('URL', '');
define('ROOT', dirname(__FILE__));
define('DS', dirname(DIRECTORY_SEPARATOR));
define('VIEW_PATH', ROOT.DS.'View'.DS);
define('CTR_PATH', ROOT.DS.'Controller'.DS);
define('MODEL_PATH', ROOT.DS.'Model'.DS);
define('VIEW_PATH_BASE','View/');
define('SITENAME','S.E.D.I');

session_start();

// Vérification de la connexion de l'utilisateur
function estConnecte() {
	return(isset($_SESSION['idUser']) && !empty($_SESSION['idUser']));
}

?>
