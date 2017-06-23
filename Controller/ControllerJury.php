<?php

  require_once MODEL_PATH."ModelGroup.php";
  require_once MODEL_PATH."ModelJury.php";
  require_once MODEL_PATH."ModelCursus.php";

if(!estConnecte()) {
  $messageErreur="Vous n'êtes pas connecté! Veuillez vous connecté!";
}
else {
  if (empty($_GET)){
    header('Location:.');
  }
  else if (isset($action)){
    switch ($action) {

      //-----Gestion des Jury-----
      case "gestionJury":
        // On vérifie que l'utilisateur à les droits necessaires
        if (((int)$_SESSION['droits'] & AFFICHER_JURY)){
          // On récupere la liste des étudiant avec un selectall()
          $listJury=ModelJury::selectAll();
          $notification = NULL;
          // l'utilisateur est renvoyé vers la vue de gestion des cursus
          $view="Gestion";
          $pagetitle="Gestion des Jury";
        }
        // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
        else {
          $view="restricted";
          $pagetitle="Accès interdit";
        }
      break;

      case "detailJury":
        // On vérifie que l'utilisateur à les droits necessaires
        if (((int)$_SESSION['droits'] & AFFICHER_JURY)){
          if (!(isset($_POST['id']))) {
            // L'utilisateur est renvoyé à la gestion des étudiant
            header('Location:jury.php?action=gestionJury');
          }
          // On crée le tableau avec l'INE de l'étudiant
          $data = array("idJury"=>$_POST['id']);
          $dataJury=ModelJury::selectWhere($data);
          $cursus = $dataJury[0]->idCursus;
          $notification = NULL;
          // l'utilisateur est renvoyé vers la vue de gestion des cursus
          $view="Detail";
          $pagetitle="Détail du Jury";
        }
        // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
        else {
          $view="restricted";
          $pagetitle="Accès interdit";
        }
      break;

      case "addJury":
        // On vérifie que l'utilisateur à les droits necessaires
        if (((int)$_SESSION['droits'] & AFFICHER_JURY)){
          $listCursus=ModelCursus::selectAll();
          $action='add';
          $view="Add";
          $pagetitle="Création d'un jury";
        }
        // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
        else {
          $view="restricted";
          $pagetitle="Accès interdit";
        }
      break;

      case "addedJury":
        // On vérifie que l'utilisateur à les droits necessaires
        if (((int)$_SESSION['droits'] & AFFICHER_JURY)){
          $data = array(
            "idCursus" => $_POST["cursus"]
          );
          $JuryExiste=ModelJury::selectWhere($data);
          if ($JuryExiste != null) {
            $listJury=ModelJury::selectAll();
            $notification = "Le jury existe déja pour ce cursus";
            $view="Gestion";
            $pagetitle="Erreur";
          }
          else {
            ModelJury::insert($data);
            $listJury=ModelJury::selectAll();
            $notification = "Le jury a bien été crée";
            $view="Gestion";
            $pagetitle="Jury crée !";
          }
        }
        // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
        else {
          $view="restricted";
          $pagetitle="Accès interdit";
        }
      break;

      case "deletedJury":
        // On vérifie que l'utilisateur à les droits necessaires
        if (((int)$_SESSION['droits'] & AFFICHER_JURY)){
          // Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
          if (!(isset($_POST['id']))) {
            // L'utilisateur est renvoyé à la gestion des étudiant
            header('Location:jury.php?action=gestionJury');
          }
          // On crée le tableau avec l'INE de l'étudiant
          $data = array("idJury"=>$_POST['id']);
          // On appel la fonction de selection
          $donneesok=ModelJury::selectWhere($data);
          // On vérifie que la selection renvoie bien quelque chose
          if($donneesok==null){
            // Sinon l'utilisateur et renvoyé la la vue de gestion des jury
            header('Location:jury.php?action=gestionJury');
          }
          // On effectue la suppression avec la fonction delete()
          ModelJury::delete($data);
          // l'utilisateur est renvoyé vers la vue de confirmation de suppression
          $listJury=ModelJury::selectAll();
          $notification = "Le jury à bien était supprimer";
          $view="Gestion";
          $pagetitle="Jury supprimé !";
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
