<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <!--[if IE]>
			  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		    <![endif]-->
        <title> <?php echo SITENAME." - "; if (isset($pagetitle)) echo "$pagetitle"; else echo "Erreur" ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Site de suivi des Etudiant du Département Informatique">
		    <meta name="author" content="Bargoin Lukas, Djabiri Abalkassim, Dunesme Teddy, Moraud Guilhaume">

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

        <!-- CSS Libs -->
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/animate.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/bootstrap-switch.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/checkbox3.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/dataTables.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>lib/css/select2.min.css">

        <!-- CSS App -->
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= VIEW_PATH_BASE; ?>css/themes/flat-blue.css">

        <!-- Javascript -->
        <script src="<?= VIEW_PATH_BASE; ?>js/functions.js"></script>

		</head>

    <body>
        <?php if(estConnecte() and $view != "Connexion") include_once VIEW_PATH.'menu.php';?>
