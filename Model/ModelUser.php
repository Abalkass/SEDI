<?php

require_once ("Model.php");

class ModelUser extends Model{

  protected static $table="User";
  protected static $primary_index="idUser";

  public static function connexion($data) {
    $_SESSION['idUser'] = $data['idUser'];
    $_SESSION['pseudo'] = $data['pseudo'];
    $_SESSION['nom'] = $data['nom'];
    $_SESSION['prenom'] = $data['prenom'];
    $_SESSION['img_profile'] = $data['img_profile'];
    $_SESSION['idGroupe'] = $data['idGroupe'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['droits'] = addslashes($data['permission']);
  }

  public static function deconnexion(){
		session_unset(); //détruit toutes les variables de la session courante
        session_destroy(); // Détruit la session
	}

}

?>
