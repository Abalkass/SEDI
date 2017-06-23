<?php

require_once MODEL_PATH."ModelUser.php";
require_once MODEL_PATH."ModelGroup.php";
require_once MODEL_PATH."ModelTeacher.php";
require_once MODEL_PATH."ModelStudent.php";
require_once ROOT.DS.'Conf'.DS.'Security.php';


// On vérifie que l'action est bien déterminé dans l'URL
if (empty($_GET)) {
  header('Location:index.php?action=connexion');
}
else if (isset($action)) {
switch ($action) {

  /*
   * Action qui permet d'accéder au formulaire de connexion
   */
  case "connexion":
    // Si l'utilisateur n'est pas connecté
    if(!estConnecte()){
      // On redirige l'utilisateur vers la vue du formulaire de connexion
      $notification = NULL;
      $view="Connexion";
      $pagetitle='Connexion';
      break;
    }
    // Si l'utilisateur est déja connecté
    else{
      // On le redirige vers l'accueil du site
      header('Location:indexConnecte.php');
    }
  break;

  /*
   * Action chargé de la vérification des données saisies dans le formulaire et de l'ouverture de la session
   */
  case "connect":
    // Si l'utilisateur n'est pas connecté
    if(!estConnecte()){
      // On vérifie que c'est le bon formulaire qui a été posté
      if (!(isset($_POST['pseudo']) && isset($_POST['password']))){
        // On redirige l'utilisateur vers la vue du formulaire de connexion
        header('Location:.');
      }
      // On crée un tableau avec les données posté
      $data = array(
      "email" => $_POST['email'],
      "password" => hash('sha256',$_POST['password'])
      );
      // On fait la selection dans la BDD à partir du tableau précédent
      $user = ModelUser::selectWhere($data);
      // Si l'utilisateur existe
      if($user != null) {
        // On crée un tableau avec l'identifiant du groupe de permission de l'utilisateur
        $idGroupe = array(
          "idPermission" => $user[0]->idGroupe
        );
        // On récupère les données de la table Permission pour l'idGroupe de l'utilisateur qui tente de ce connecté
        $groupe = ModelGroup::selectWhere($idGroupe);
        // On crée le tableau que l'ont va envoyé à la fonction de connexion
        $data2 = array(
          "idUser" => $user[0]->idUser,
          "nom" => $user[0]->nom,
          "prenom" => $user[0]->prenom,
          "img_profile"=> $user[0]->img_profile,
          "idGroupe" => $user[0]->idGroupe,
          "email" => $user[0]->email,
          "permission" => $groupe[0]->permission
        );
        // On appel la fonciton de connexion avec le tableau précédent
        ModelUser::connexion($data2);
        // Si c'est la première connexion de l'utilisateur
        if($user[0]->premiere_connexion == "oui") {
          // L'utilisateur est rediriger vers la vue de modification de mot de passe
          $view="ChgPassword";
          $pagetitle="Changement du mot de passe";
        }
        // Sinon
        else {
          // On redirige l'utilisateur vers la page d'accueil du site
          header('Location:indexConnecte.php');
        }
      }
      // Si l'utilisateur n'existe pas dans la BDD
      else{
        $view = "Connexion";
        $pagetitle='Connexion';
        $notification="Pseudo ou mot de passe erroné !";
      }
    }
    // Si l'utilisateur est déja connecté
    else{
      // On redirige l'utilisateur vers la page d'accueil du site
      header('Location:indexConnecte.php');
    }
   break;

   /*
    * Action chargé de l'affiche du formulaire de modification de mot de passe lors de la première connexion
    */
   case "changedPassword":
    // Si l'utilisateur est connecté
    if(estConnecte()){
      // On vérifie que c'est le bon formulaire qui a été posté
      if (!(isset($_POST['password1']) && isset($_POST['password2']))) {
        $view="ChgPassword";
        $pagetitle="Changement du mot de passe";
      }
      // On crée le tableau que l'ont va envoyé a la fonction d'update
      $data = array(
        "password" => $_POST["password1"],
        "idUser" => $_SESSION['idUser'],
        "premiere_connexion" => "non"
      );
      // Si les deux mots de passe correspondent
      if($data['password']==$_POST["password2"]){
        // On crypte le mot de passe
        $data['password'] = hash('sha256',$_POST["password1"]);
        // On effectue la mise a jours du mot de passe
        ModelUser::update($data);
        // On redirige vers la page d'accueil du site
        header('Location:indexConnecte.php');
        }
      // Si les deux mots de passe ne correspondent pas
      else {
        $messageErreur="Vous avez saisi deux mots de passe différents !";
        break;
      }
    }
    // Si il n'est pas connecté
    else {
      // On le redirige vers la page de connexion
      header('Location:.');
    }
   break;

   /*
    * Cas qui gère la deconnexion de l'utilisateur
    */
   case "deconnexion":
      ModelUser::deconnexion();
      header('Location:.');
   break;

   /*
   * Gestion des utilisateurs
   */
   case "gestionUser":
     // On vérifie que l'utilisateur à les droits necessaires
     if (((int)$_SESSION['droits'] & AFFICHER_UTILISATEURS)){
       // On appel la fonction selectAll() pour récupéré tout les utilisateurs de la base de donnée et on stock dans listUsers
       $listUsers=ModelUser::selectAll();
       $notification = NULL;
       // L'utilisateur est renvoyé vers la vue de gestion des utilisateurs
       $view="Gestion";
       $pagetitle="Gestion des utilisateurs";
     }
     // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
     else {
     $view="restricted";
     $pagetitle="Accès interdit";
     }
   break;

   case "addUserStatut":
     // On vérifie que l'utilisateur à les droits necessaires
     if (((int)$_SESSION['droits'] & AJOUTER_UTILISATEUR)){
       // L'utilisateur est renvoyé vers la vue de choix du statut de l'étudiant à ajouté
       $view="AddStatut";
       $pagetitle="Ajout d'un utilisateur";
       }
     // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
     else {
       $view="restricted";
       $pagetitle="Accès interdit";
     }
   break;

   case "addUser":
     // On vérifie que l'utilisateur à les droits necessaires
     if (((int)$_SESSION['droits'] & AJOUTER_UTILISATEUR)){
       // On vérifie qu'un statut à bien était sélectionné dans la liste
       if (!(isset($_POST['statut']))) {
       // Sinon l'utilisateur est renvoyé vers la vue de choix du statut de l'étudiant à ajouté
         header('Location:user.php?action=addUserStatut');
       }
       else {
         $statut = $_POST['statut'];
         // On appel la fonction selectAll() pour récupéré la liste des enseignant, la liste des étudiant et la liste des groupes de permissions
         $listEnseignant=ModelTeacher::selectAll();
         $listEtudiant=ModelStudent::selectAll();
         $listGroup=ModelGroup::selectAll();
         // L'utilisateur est renvoyé vers la vue AddUpUser
         $action='add';
         $view="AddUpd";
         $pagetitle="Ajout d'un utilisateur";
       }
     }
     // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
     else {
       $view="restricted";
       $pagetitle="Accès interdit";
     }
   break;

   case "addedUser":
     // On vérifie que l'utilisateur à les droits necessaires
     if (((int)$_SESSION['droits'] & AJOUTER_UTILISATEUR)){
     // On vérifie que l'utilisateur a bien été selectionné et également le groupe de permission à affecter
       if (!(isset($_POST['utilisateur']) && isset($_POST['groupe']) )) {
         // Sinon l'utilisateur est renvoyé à la vue précedente
         header('Location:user.php?action=addUpdUser');
       }
       else {
       // Selon le statut de l'utilisateur à ajouter on configure la clé primaire et la model
         if ($_POST['statut'] == "etudiant"){
           $primary_key = "INE";
           $model = "ModelStudent";
         }
         if ($_POST['statut'] == "enseignant"){
           $primary_key = "idTeacher";
           $model = "ModelTeacher";
         }
         // On crée un tableau contenant la clé primaire de l'utilisateur (INE ou NUMEN)
         $idUser = array("$primary_key"=>$_POST['utilisateur']);
         // On appel la fonction selectWhere pour récupéré les données de l'utilisateur que l'ont veut ajouter.
         $user = $model::selectWhere($idUser);
         // On affecte INE ou NUMEN comme mot de passe de première connexion
         $password = $user[0]->$primary_key;
         // On crée le tableau avec les données que l'ont va envoyé pour l'insertion dans la base de donnée
         $data = array(
           "statut" => $_POST["statut"],
           "nom" => $user[0]->nom,
           "prenom" => $user[0]->prenom,
           "email" => $user[0]->email,
           "idGroupe" => $_POST["groupe"]
         );
         // On crypte le mot de passe
         $generateMDP = Security::generateMDP();
         $data['password'] = hash('sha256',$generateMDP);
         // On effectue l'insertion dans la base de donnée
         ModelUser::insert($data);
         //-----------Création de l'émail-----------
         // Création du header de l'e-mail.
         $header = "de: <ne-pas-repondre@sedi.fr>\r\n";
         // Création du message.
         $message = "Vous êtes maintenant inscrit sur le site SEDI ! \r\n Pour vous connecter à votre compte utilisez votre email et le mot de passe suivant: $generateMDP \r\n Cordialement, l'équipe de SeenInmovies \r\n";
         // Création du destinataire du mail.
         $to = $data['email'];
         // Création du destinataire du mail.
         $subject = "Confirmation d'inscription à SEDI";
         // Envoie de l'email
         mail($to, $subject, $message, $header);
         // L'utilisateur est renvoyé vers la vue de confirmation d'ajout de l'utilisateur
         $notification = "L'utilisateur à bien été crée";
         $listUsers=ModelUser::selectAll();
         $view="Gestion";
         $pagetitle="Utilisateur ajouté";
       }
     }
     // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
     else {
       $view="restricted";
       $pagetitle="Accès interdit";
     }
   break;

   case "deletedUser":
     // On vérifie que l'utilisateur à les droits necessaires
     if (((int)$_SESSION['droits'] & SUPPRIMER_UTILISATEUR)){
       // Si on n'a pas l'identifiant de l'utilisateur lors de l'envoie du formulaire
       if (!(isset($_POST['id']))) {
         // L'utilisateur est renvoyé à la gestion des utilisateurs
         header('Location:admin.php?action=gestionUser');
       }
       // On crée le tableau avec l'identifiant de l'utilisateur
       $data = array("idUser"=>$_POST['id']);
       // On appel la fonction de selection
       $donneesok=ModelUser::selectWhere($data);
       // On vérifie que la selection renvoie bien quelque chose
       if($donneesok==null){
         // Sinon l'utilisateur et renvoyé la la vue de gestion des utilisateurs
         header('Location:admin.php?action=gestionUser');
       }
       // On effectue la suppression avec la fonction delete()
       ModelUser::delete($data);
       // l'utilisateur est renvoyé vers la vue de confirmation de suppression
       $notification = "L'utilisateur à bien été supprimer";
       $listUsers=ModelUser::selectAll();
       $view="Gestion";
       $pagetitle="Utilisateur supprimé !";
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

require VIEW_PATH."view.php";

?>
