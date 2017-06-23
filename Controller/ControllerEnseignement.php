<?php

  require_once MODEL_PATH."ModelCursus.php";
  require_once MODEL_PATH."ModelUE.php";
  require_once MODEL_PATH."ModelModule.php";
  require_once MODEL_PATH."ModelGroup.php";
  require_once MODEL_PATH."ModelStudent.php";
  require_once MODEL_PATH."ModelEstStudent.php";

  if(!estConnecte()) {
    $messageErreur="Vous n'êtes pas connecté! Veuillez vous connecté!";
  }
  else {
    if (empty($_GET)){
      header('Location:.');
    }
    else if (isset($action)){
      switch ($action) {

        //-----Gestion des Cursus-----
				case "gestionCursus":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AFFICHER_CURSUS)){
						// On récupere la liste des étudiant avec un selectall()
						$listCursus=ModelCursus::selectAll();
            $notification = NULL;
						// l'utilisateur est renvoyé vers la vue de gestion des cursus
						$view="GestionCursus";
						$pagetitle="Gestion des cursus";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

				case "detailCursus":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AFFICHER_CURSUS)){
            if (!(isset($_POST['id']))) {
							// L'utilisateur est renvoyé à la gestion des étudiant
							header('Location:enseignement.php?action=gestionCursus');
						}
						// On crée le tableau avec l'INE de l'étudiant
						$data = array("idCursus"=>$_POST['id']);
            $cursus = $_POST['id'];
						$listStudentsCursus=ModelEstStudent::selectStudentCursus($data);
            $notification = NULL;
						// l'utilisateur est renvoyé vers la vue de gestion des cursus
						$view="DetailCursus";
						$pagetitle="Détail du cursus";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "addCursus":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AJOUTER_CURSUS)){
						// L'utilisateur est renvoyé vers le formulaire d'ajout de cursus
						$action='add';
						$view="AddCursus";
						$pagetitle="Ajout d'un Cursus";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "addedCursus": // formulaire a sécurisé
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AJOUTER_CURSUS)){
						// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
						$domaine = $_POST["domaine"];
						$annee = $_POST["annee"];
						$semestre = $_POST["semestre"];
						$annee_domaine = $_POST["annee_domaine"];
						$idCursus = $domaine."_".$annee_domaine.$semestre."_".$annee;
						$data = array(
							"idCursus" => $idCursus, // On récupere les valeur en lettres minuscules
							"domaine" => strtolower($_POST["domaine"]),
							"annee" => strtolower($_POST["annee"]),
              "annee_form" => strtolower($_POST["annee_domaine"]),
							"semestre" => strtolower($_POST["semestre"])
						);
						// On crée un tableau avec les valeurs du formulaire que l'ont veut vérifier dans la base de données (ici l'INE)
						$dataCheck = array(
							"idCursus" => $idCursus
						);
						// On effectue la selection dans la baes de donnée
						$Cursusexist = ModelCursus::selectWhere($dataCheck);
						// S'il exite déja un étudiant avec ce nom et ce prénom
					  if ($Cursusexist != null) {
						 $messageErreur="Ce cursus existe déja!";
					  }
						else {
							// On effectue l'insertion dans la base de donnée
							ModelCursus::insert($data);
              for ($c=1; $c <= $_POST["nbUE"]; $c++) {
                $idUE = "UE".$c."_".$domaine."_".$annee_domaine.$semestre."_".$annee;
                $dataUE = array(
                  "idUE" => $idUE,
  							  "idCursus" => $idCursus
  						  );
                ModelUE::insert($dataUE);
              }
              $listCursus=ModelCursus::selectAll();
              $notification = "Le Cursus à bien était ajouté";
							$view="GestionCursus";
							$pagetitle="Cursus ajouté !";
						}
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "deletedCursus":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & SUPPRIMER_CURSUS)){
						// Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
						if (!(isset($_POST['id']))) {
							// L'utilisateur est renvoyé à la gestion des étudiant
							header('Location:enseignement.php?action=gestionCursus');
						}
						// On crée le tableau avec l'INE de l'étudiant
						$data = array("idCursus"=>$_POST['id']);
						// On appel la fonction de selection
						$donneesok=ModelCursus::selectWhere($data);
						// On vérifie que la selection renvoie bien quelque chose
						if($donneesok==null){
							// Sinon l'utilisateur et renvoyé la la vue de gestion des étudiant
							header('Location:enseignement.php?action=gestionCursus');
						}
						// On effectue la suppression avec la fonction delete()
						ModelCursus::delete($data);
						// l'utilisateur est renvoyé vers la vue de confirmation de suppression
            $listCursus=ModelCursus::selectAll();
            $notification = "Le Cursus à bien était supprimer";
						$view="GestionCursus";
						$pagetitle="Cursus supprimé !";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "deletedStudentCursus":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & SUPPRIMER_CURSUS)){
						// Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
						if (!(isset($_POST['id']))) {
							// L'utilisateur est renvoyé à la gestion des étudiant
							header('Location:enseignement.php?action=detailCursus');
						}
						// On crée le tableau avec l'INE de l'étudiant
						$data = array("INE"=>$_POST['id']);
						// On appel la fonction de selection
						$donneesok=ModelEstStudent::selectWhere($data);
						// On vérifie que la selection renvoie bien quelque chose
						if($donneesok==null){
							// Sinon l'utilisateur et renvoyé la la vue de gestion des étudiant
							header('Location:enseignement.php?action=detailCursus');
						}
						// On effectue la suppression avec la fonction delete()
						ModelEstStudent::delete($data);
            $data = array("idCursus"=>$_POST['cursus']);
            $cursus = $_POST['cursus'];
						$listStudentsCursus=ModelEstStudent::selectStudentCursus($data);
            $notification = "L'étudiant à bien était supprimer du cursus";
						$view="DetailCursus";
						$pagetitle="Etudiant supprimer du cursus!";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        //-----Gestion des UE-----
				case "gestionUE":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AFFICHER_CURSUS)){
						// On récupere la liste des étudiant avec un selectall()
						$listUE=ModelUE::selectAll();
            $notification = NULL;
						// l'utilisateur est renvoyé vers la vue de gestion des cursus
						$view="GestionUE";
						$pagetitle="Gestion des UE";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "deletedUE":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & SUPPRIMER_CURSUS)){
						// Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
						if (!(isset($_POST['id']))) {
							// L'utilisateur est renvoyé à la gestion des étudiant
							header('Location:enseignement.php?action=gestionUE');
						}
						// On crée le tableau avec l'INE de l'étudiant
						$data = array("idUE"=>$_POST['id']);
						// On appel la fonction de selection
						$donneesok=ModelUE::selectWhere($data);
						// On vérifie que la selection renvoie bien quelque chose
						if($donneesok==null){
							// Sinon l'utilisateur et renvoyé la la vue de gestion des UE
							header('Location:enseignement.php?action=gestionUE');
						}
						// On effectue la suppression avec la fonction delete()
						ModelUE::delete($data);
						// l'utilisateur est renvoyé vers la vue de confirmation de suppression
            $listUE=ModelUE::selectAll();
            $notification = "L'UE à bien était supprimer";
						$view="GestionUE";
						$pagetitle="UE supprimé !";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "addUE":
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AJOUTER_CURSUS)){
						// L'utilisateur est renvoyé vers le formulaire d'ajout de cursus
						$action='add';
            $listCursus=ModelCursus::selectAll();
						$view="AddUE";
						$pagetitle="Ajout d'un Cursus";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

        case "addedUE": // formulaire a sécurisé
					// On vérifie que l'utilisateur à les droits necessaires
					if (((int)$_SESSION['droits'] & AJOUTER_CURSUS)){
						// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
						$data = array(
							"idCursus" => $_POST["cursus"]
						);
						// On effectue la selection dans la baes de donnée
            $cursus = ModelCursus::select($data);
						$UECursus = ModelUE::selectWhere($data);
						// S'il exite déja un étudiant avec ce nom et ce prénom
            $nbUECursus = sizeof($UECursus);
            $nbUE = $nbUECursus + 1;
            $idUE = "UE".$nbUE."_".$cursus->domaine."_".$cursus->annee_form.$cursus->semestre."_".$cursus->annee;
            $dataUE = array(
              "idUE" => $idUE,
  						"idCursus" => $_POST["cursus"]
  					);
            ModelUE::insert($dataUE);
            $listUE=ModelUE::selectAll();
            $notification = "Cette UE à bien était ajoutée";
						$view="GestionUE";
						$pagetitle="UE ajouté!";
					}
					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
					else {
						$view="restricted";
						$pagetitle="Accès interdit";
					}
				break;

      }
    }
    else {
      header('Location:.');
    }
  }

require VIEW_PATH."view.php";

?>
