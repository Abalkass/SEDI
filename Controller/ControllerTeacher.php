<?php

  require_once MODEL_PATH."ModelTeacher.php";
  require_once MODEL_PATH."ModelGroup.php";

  if(!estConnecte()) {
    $messageErreur="Vous n'êtes pas connecté! Veuillez vous connecté!";
  }
  else {
    if (empty($_GET)){
      header('Location:.');
    }
    else if (isset($action)){
      switch ($action) {

        //-----Gestion des Enseignant-----
  			case "gestionTeacher":
  				// On vérifie que l'utilisateur à les droits necessaires
  				if (((int)$_SESSION['droits'] & AFFICHER_ENSEIGNANTS)){
  					// On récupere la liste des enseignant avec un selectall()
  					$listTeacher=ModelTeacher::selectAll();
            $notification = NULL;
  					// l'utilisateur est renvoyé vers la vue de gestion des enseignants
  					$view="Gestion";
  					$pagetitle="Gestion des enseignants";
  				}
  				// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
  				else {
  					$view="restricted";
  					$pagetitle="Accès interdit";
  				}
  			break;

  			case "addTeacher":
  				// On vérifie que l'utilisateur à les droits necessaires
  				if (((int)$_SESSION['droits'] & AJOUTER_ENSEIGNANT)){
  					// L'utilisateur est renvoyé vers le formulaire d'ajout d'enseignant
  					$action='add';
  					$view="AddUpd";
  					$pagetitle="Ajout d'un enseignant";
  				}
  				// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
  				else {
  					$view="restricted";
  					$pagetitle="Accès interdit";
  				}
  			break;

  			case "addedTeacher":
  				// On vérifie que l'utilisateur à les droits necessaires
  				if (((int)$_SESSION['droits'] & AJOUTER_ENSEIGNANT)){
  					// On vérifie que l'utilisateur a bien saisi tout les données necessaires
  					if (!(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['statut']) )) {
  							header('Location:teacher.php?action=addTeacher');
  					}
  					// Il faut vérifier les données en plus du html
  					// Vérification de l'email
  					if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  						$messageErreur="Vous n'avez pas saisi un e-mail valide !";
  						break;
  					}
  					// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
  					$data = array(
  						"nom" => strtolower($_POST["nom"]),
  						"prenom" => strtolower($_POST["prenom"]),
  						"email" => strtolower($_POST["email"]),
              "statut" => strtolower($_POST["statut"])
  					);
  					// On crée un tableau avec les valeurs du formulaire que l'ont veut vérifier dans la base de données
  					$dataCheck = array(
  						"nom" => strtolower($_POST["nom"]),
  						"prenom" => strtolower($_POST["prenom"])
  					);
  					// On effectue la selection dans la base de donnée
  					$Teacherexist = ModelTeacher::selectWhere($dataCheck);
  					// S'il exite déja un enseignant avec ce nom et ce prénom
  				  if ($Teacherexist != null) {
  					 $messageErreur="Cet enseignant est déja dans la base de données!";
  				  }
  					else {
  						// On effectue l'insertion dans la base de donnée
  						ModelTeacher::insert($data);
  						$notification = "L'enseignant à bien était ajouté";
              $listTeacher=ModelTeacher::selectAll();
  						$view="Gestion";
  						$pagetitle="Enseignant ajouté";
  					}
  				}
  				// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
  				else {
  					$view="restricted";
  					$pagetitle="Accès interdit";
  				}
  				break;

  				case "deletedTeacher":
  					// On vérifie que l'utilisateur à les droits necessaires
  					if (((int)$_SESSION['droits'] & SUPPRIMER_ENSEIGNANT)){
  						// Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
  						if (!(isset($_POST['id']))) {
  							// L'utilisateur est renvoyé à la gestion des étudiant
  							header('Location:teacher.php?action=gestionTeacher');
  						}
  						// On crée le tableau avec l'INE de l'étudiant
  						$data = array("idTeacher"=>$_POST['id']);
  						// On appel la fonction de selection
  						$donneesok=ModelTeacher::selectWhere($data);
  						// On vérifie que la selection renvoie bien quelque chose
  						if($donneesok==null){
  							// Sinon l'utilisateur et renvoyé la la vue de gestion des étudiant
  							header('Location:teacher.php?action=gestionTeacher');
  						}
  						// On effectue la suppression avec la fonction delete()
  						ModelTeacher::delete($data);
  						// l'utilisateur est renvoyé vers la vue de confirmation de suppression
              $notification = "L'enseignant à bien était supprimé";
              $listTeacher=ModelTeacher::selectAll();
  						$view="Gestion";
  						$pagetitle="Enseignant supprimé !";
  					}
  					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
  					else {
  						$view="restricted";
  						$pagetitle="Accès interdit";
  					}
  				break;

  				case"updateTeacher":
  					// On vérifie que l'utilisateur à les droits necessaires
  					if (((int)$_SESSION['droits'] & MODIFIER_ENSEIGNANT)){
  						// Si on pas l'id de l'étudiant, l'utilisateur est renvoyé à la vue de gestion des Etudiants
  						if (!(isset($_POST['id']))) {
  							header('Location:teacher.php?action=gestionTeacher');
  						}
  						// On crée le tableau avec l'id de la permission pour faire la selection dans la base de données
  						$data = array("idTeacher"=>$_POST['id']);
  						// On appel la fonction de selection
  						$teacher = ModelTeacher::select($data);
  						$idTeacher = $_POST['id'];
  						$nom = $teacher->nom;
  						$prenom = $teacher->prenom;
  						$email = $teacher->email;
  						$action='updat';
  						$view="AddUpd";
  						$pagetitle="Modification d'un enseignant";
  					}
  					// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
  					else {
  						$view="restricted";
  						$pagetitle="Accès interdit";
  					}
  				break;

  				case"updatedTeacher":
  				// On vérifie que l'utilisateur à les droits necessaires
  				if (((int)$_SESSION['droits'] & MODIFIER_ENSEIGNANT)){
  					// On vérifie que l'utilisateur a bien saisi tout les données necessaires
  					if (!(isset($_POST['idTeacher']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['statut']) )) {
  							header('Location:teacher.php?action=updateTeacher');
  					}
  					// Il faut vérifier les données en plus du html
  					// Vérification de l'email
  					if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  						$messageErreur="Vous n'avez pas saisi un e-mail valide !";
  						break;
  					}
  					// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
  					$data = array(
              "idTeacher"=>$_POST['idTeacher'],
  						// On récupere les valeur en lettres minuscules
  						"nom" => strtolower($_POST["nom"]),
  						"prenom" => strtolower($_POST["prenom"]),
  						"email" => strtolower($_POST["email"]),
              "statut" => strtolower($_POST["statut"])
  					);
  					ModelTeacher::update($data);
            $notification = "L'enseignant à bien était mis à jour";
            $listTeacher=ModelTeacher::selectAll();
  					$view="Gestion";
  					$pagetitle="Enseignant mis à jour !";
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
