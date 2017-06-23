<?php

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

        //-----Gestion des Groupes de permissions-----
    		case "gestionGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AFFICHER_GROUPES_PERM)){
    				// On appel la fonctions selectAll() pour récupérer la liste des groupes de la base de données
    				$listGroup=ModelGroup::selectAll();
            $notification = NULL;
    				// l'utilisaeur est renvoyé vers la vue de gestion des groupes de permission
    				$view="Gestion";
    				$pagetitle="Gestion des groupes de permission";
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

        case "addGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AJOUTER_GROUPE_PERM)){
    				// l'utilisateur est renvoyé vers le formulaire de création de groupe de permission
    				$action='add';
    				$view="AddUpd";
    				$pagetitle="Ajout d'un groupe de permission";
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

        case "addedGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AJOUTER_GROUPE_PERM)){
    				// Si le formulaire a été validé avec les donnée necessaires, on peut effectuer les actions PHP
    				if(!isset($_POST['nom']))
    					{
    					// Sinon l'utilisateur est renvoyé vers le formulaire
    					header('Location:group.php?action=addGroup');
    					}
    				else {
    					// On récupère le nom du groupe
    					$nom = $_POST['nom'];
    					// On initialise la variables qui va contenir les droits (important!)
    					$droits = 0;
    					if( $_POST['Dsp_User'] == 'dsp_User_oui') // Si dans le formulaire, on a indiqué que ce groupe pouvait afficher les utilisateurs
    			 		{
    					$droits |= AFFICHER_UTILISATEURS; // On ajoute la permission dans la variable $droits
    			 		}
    			 		if( $_POST['Add_User'] == 'add_User_oui')  // Si dans le formulaire, on a indiqué que ce groupe pouvait ajouter un utilisateur
    			 		{
    					$droits |= AJOUTER_UTILISATEUR; // On ajoute la permission dans la variable $droits
    			 		}
    					if( $_POST['Del_User'] == 'del_User_oui')  // Si dans le formulaire, on a indiqué que ce groupe pouvait ajouter un utilisateur
    			 		{
    					$droits |= SUPPRIMER_UTILISATEUR; // On ajoute la permission dans la variable $droits
    			 		}
    					if( $_POST['Dsp_Group'] == 'dsp_Group_oui') // etc ...
    			 		{
    					$droits |= AFFICHER_GROUPES_PERM; // etc...
    			 		}
    					if( $_POST['Add_Group'] == 'add_Group_oui')
    			 		{
    					$droits |= AJOUTER_GROUPE_PERM;
    			 		}
    					if( $_POST['Del_Group'] == 'del_Group_oui')
    			 		{
    					$droits |= SUPPRIMER_GROUPE_PERM;
    			 		}
    					if( $_POST['Upd_Group'] == 'upd_Group_oui')
    			 		{
    					$droits |= MODIFIER_GROUPE_PERM;
    			 		}
    					if( $_POST['Dsp_Student'] == 'dsp_Student_oui')
    			 		{
    					$droits |= AFFICHER_ETUDIANTS;
    			 		}
    					if( $_POST['Add_Student'] == 'add_Student_oui')
    			 		{
    					$droits |= AJOUTER_ETUDIANT;
    			 		}
    					if( $_POST['Del_Student'] == 'del_Student_oui')
    			 		{
    					$droits |= SUPPRIMER_ETUDIANT;
    			 		}
    					if( $_POST['Upd_Student'] == 'upd_Student_oui')
    			 		{
    					$droits |= MODIFIER_ETUDIANT;
    			 		}
    					if( $_POST['Dsp_Teacher'] == 'dsp_Teacher_oui')
    			 		{
    					$droits |= AFFICHER_ENSEIGNANTS;
    			 		}
    					if( $_POST['Add_Teacher'] == 'add_Teacher_oui')
    			 		{
    					$droits |= AJOUTER_ENSEIGNANT;
    			 		}
    					if( $_POST['Del_Teacher'] == 'del_Teacher_oui')
    			 		{
    					$droits |= SUPPRIMER_ENSEIGNANT;
    			 		}
    					if( $_POST['Upd_Teacher'] == 'upd_Teacher_oui')
    			 		{
    					$droits |= MODIFIER_ENSEIGNANT;
    			 		}
    					if( $_POST['Dsp_Cursus'] == 'dsp_Cursus_oui')
    			 		{
    					$droits |= AFFICHER_CURSUS;
    			 		}
    					if( $_POST['Add_Cursus'] == 'add_Cursus_oui')
    			 		{
    					$droits |= AJOUTER_CURSUS;
    			 		}
    					if( $_POST['Del_Cursus'] == 'del_Cursus_oui')
    			 		{
    					$droits |= SUPPRIMER_CURSUS;
    			 		}
    					if( $_POST['Dsp_Jury'] == 'dsp_Jury_oui')
    			 		{
    					$droits |= AFFICHER_JURY;
    			 		}
    					if( $_POST['Dsp_Module'] == 'dsp_Module_oui')
    			 		{
    					$droits |= AFFICHER_MODULES;
    			 		}
    					if( $_POST['Add_Module'] == 'add_Module_oui')
    			 		{
    					$droits |= AJOUTER_MODULE;
    			 		}
    					if( $_POST['Del_Module'] == 'del_Module_oui')
    			 		{
    					$droits |= SUPPRIMER_MODULE;
    			 		}
    					if( $_POST['Upd_Module'] == 'upd_Module_oui')
    			 		{
    					$droits |= MODIFIER_MODULE;
    			 		}
    					// On crée le tableau des donnée que l'ont va envoyé à la requête
    					$data = array(
    						"nom" => $nom,
    						"permission" => $droits
    					);
    					// On appel la fonction d'insertion
    					ModelGroup::insert($data);
    					// L'utilisaeur est renvoyé vers la vue de confirmationd d'ajout du groupe
              $notification = "Le groupe de permission à bien crée.";
              $listGroup=ModelGroup::selectAll();
    					$view="Gestion";
    					$pagetitle="Ajout d'un groupe de permission";
    				}
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

        case "updateGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & MODIFIER_GROUPE_PERM)){
    				// Si on pas l'id du groupe, l'utilisateur est renvoyé à la vue de gestion des groupes
    				if (!(isset($_POST['id']))) {
    					header('Location:group.php?action=gestionUser');
    				}
    				// On crée le tableau avec l'id de la permission pour faire la selection dans la base de données
    				$data = array("idPermission"=>$_POST['id']);
    				// On appel la fonction de selection et on stock la reposne dans $group (! la fonction retourne un objet)
    				$group = ModelGroup::select($data);
    				$id = $_POST['id'];
    				// On récupère le nom et la valeur de permission dans des variables séparé
    				$nom  = $group->nom;
    				$permission = $group->permission;
    				if (((int)$permission & AFFICHER_UTILISATEURS)) // On vérifie si le droit a été attribué
            	{
              $selected_dsp_User = 1; // si oui, on affecte la variable à 1
            	}
            else
            	{
              $selected_dsp_User = 0; // sinon on l'affecte à 0
            	}
    				if (((int)$permission & AJOUTER_UTILISATEUR)) // etc...
            	{
              $selected_add_User = 1;
            	}
            else
            	{
              $selected_add_User = 0;
            	}
            if (((int)$permission & SUPPRIMER_UTILISATEUR))
        			{
              $selected_del_User = 1;
        			}
            else
            	{
            	$selected_del_User = 0;
            	}
    				if (((int)$permission & AFFICHER_GROUPES_PERM))
    					{
    					$selected_dsp_Group = 1;
    					}
    				else
    					{
    					$selected_dsp_Group = 0;
    					}
    				if (((int)$permission & AJOUTER_GROUPE_PERM))
    	        {
    	        $selected_add_Group = 1;
    	        }
    	      else
    	        {
    	        $selected_add_Group = 0;
    	        }
    				if (((int)$permission & SUPPRIMER_GROUPE_PERM))
    	    		{
    	        $selected_del_Group = 1;
    	    		}
    	      else
    	        {
    	        $selected_del_Group = 0;
    	        }
    				if (((int)$permission & MODIFIER_GROUPE_PERM))
    					{
    					$selected_upd_Group = 1;
    					}
    				else
    					{
    					$selected_upd_Group = 0;
    					}
    				if (((int)$permission & AFFICHER_ETUDIANTS))
    					{
    					$selected_dsp_Student = 1;
    					}
    				else
    					{
    					$selected_dsp_Student = 0;
    					}
    				if (((int)$permission & AJOUTER_ETUDIANT))
    		      {
    		      $selected_add_Student = 1;
    	        }
    	      else
    		      {
    		      $selected_add_Student = 0;
    	        }
    				if (((int)$permission & SUPPRIMER_ETUDIANT))
    		    	{
    		      $selected_del_Student = 1;
    		  		}
    		    else
    		      {
    		      $selected_del_Student = 0;
    		      }
    				if (((int)$permission & MODIFIER_ETUDIANT))
    					{
    					$selected_upd_Student = 1;
    					}
    				else
    					{
    					$selected_upd_Student = 0;
    					}
    				if (((int)$permission & AFFICHER_ENSEIGNANTS))
    					{
    					$selected_dsp_Teacher = 1;
    					}
    				else
    					{
    					$selected_dsp_Teacher = 0;
    					}
    				if (((int)$permission & AJOUTER_ENSEIGNANT))
        			{
    			    $selected_add_Teacher = 1;
    		      }
    		    else
    		      {
    			    $selected_add_Teacher = 0;
    		      }
    				if (((int)$permission & SUPPRIMER_ENSEIGNANT))
    			  	{
    		      $selected_del_Teacher = 1;
    		  		}
    		    else
    		      {
    		      $selected_del_Teacher = 0;
    		      }
    				if (((int)$permission & MODIFIER_ENSEIGNANT))
    					{
    					$selected_upd_Teacher = 1;
    					}
    				else
    					{
    					$selected_upd_Teacher = 0;
    					}
    				if (((int)$permission & AFFICHER_CURSUS))
    					{
    					$selected_dsp_Cursus = 1;
    					}
    				else
    					{
    					$selected_dsp_Cursus = 0;
    					}
    				if (((int)$permission & AJOUTER_CURSUS))
    	    		{
    				  $selected_add_Cursus = 1;
    			    }
    			  else
    			    {
    				  $selected_add_Cursus = 0;
    			    }
    				if (((int)$permission & SUPPRIMER_CURSUS))
    					{
    			    $selected_del_Cursus = 1;
    			  	}
    			  else
    			    {
    			    $selected_del_Cursus = 0;
    			    }
    				if (((int)$permission & AFFICHER_JURY))
    					{
    					$selected_dsp_Jury = 1;
    					}
    				else
    					{
    					$selected_dsp_Jury = 0;
    					}
    				if (((int)$permission & AFFICHER_MODULES))
    					{
    					$selected_dsp_Module = 1;
    					}
    				else
    					{
    					$selected_dsp_Module = 0;
    					}
    				if (((int)$permission & AJOUTER_MODULE))
    					{
    					$selected_add_Module = 1;
    					}
    				else
    					{
    					$selected_add_Module = 0;
    					}
    				if (((int)$permission & SUPPRIMER_MODULE))
    					{
    					$selected_del_Module = 1;
    					}
    				else
    					{
    					$selected_del_Module = 0;
    					}
    				if (((int)$permission & MODIFIER_MODULE))
    					{
    					$selected_upd_Module = 1;
    					}
    				else
    					{
    					$selected_upd_Module = 0;
    					}
    				// L'utilisateur est renvoyé vers le formulaire
    				$action='updat';
    				$view="AddUpd";
    				$pagetitle="Modification d'un groupe de permission";
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

    		case "updatedGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & MODIFIER_GROUPE_PERM)){
    				// Si le nom du groupe n'est pas saisi
    				if(!isset($_POST['nom']))
    					{
    						// l'utilisateur est renvoyé au formulaire
    						header('Location:group.php?action=updatGroup');
    					}
    				else {
    					// Le nom du groupe
    					$nom = $_POST['nom'];
    					// Initlialisation de la variable $droit
    					$droits = 0;
    					if( $_POST['Dsp_User'] == 'dsp_User_oui')
    					{
    						$droits |= AFFICHER_UTILISATEURS;
    					}
    					if( $_POST['Add_User'] == 'add_User_oui')  // Si dans le formulaire, on a indiqué que ce groupe pouvait ajouter un utilisateur
    					{
    						$droits |= AJOUTER_UTILISATEUR; // On ajoute la permission dans la variable $droits
    					}
    					if( $_POST['Del_User'] == 'del_User_oui')  // Si dans le formulaire, on a indiqué que ce groupe pouvait ajouter un utilisateur
    					{
    						$droits |= SUPPRIMER_UTILISATEUR; // On ajoute la permission dans la variable $droits
    					}
    					if( $_POST['Dsp_Group'] == 'dsp_Group_oui')
    					{
    					$droits |= AFFICHER_GROUPES_PERM;
    					}
    					if( $_POST['Add_Group'] == 'add_Group_oui')
    					{
    					$droits |= AJOUTER_GROUPE_PERM;
    					}
    					if( $_POST['Del_Group'] == 'del_Group_oui')
    					{
    					$droits |= SUPPRIMER_GROUPE_PERM;
    					}
    					if( $_POST['Upd_Group'] == 'upd_Group_oui')
    					{
    					$droits |= MODIFIER_GROUPE_PERM;
    					}
    					if( $_POST['Dsp_Student'] == 'dsp_Student_oui')
    					{
    					$droits |= AFFICHER_ETUDIANTS;
    					}
    					if( $_POST['Add_Student'] == 'add_Student_oui')
    					{
    					$droits |= AJOUTER_ETUDIANT;
    					}
    					if( $_POST['Del_Student'] == 'del_Student_oui')
    					{
    						$droits |= SUPPRIMER_ETUDIANT;
    					}
    					if( $_POST['Upd_Student'] == 'upd_Student_oui')
    					{
    						$droits |= MODIFIER_ETUDIANT;
    					}
    					if( $_POST['Dsp_Teacher'] == 'dsp_Teacher_oui')
    			 		{
    					$droits |= AFFICHER_ENSEIGNANTS;
    			 		}
    					if( $_POST['Add_Teacher'] == 'add_Teacher_oui')
    			 		{
    					$droits |= AJOUTER_ENSEIGNANT;
    			 		}
    					if( $_POST['Del_Teacher'] == 'del_Teacher_oui')
    			 		{
    					$droits |= SUPPRIMER_ENSEIGNANT;
    			 		}
    					if( $_POST['Upd_Teacher'] == 'upd_Teacher_oui')
    			 		{
    					$droits |= MODIFIER_ENSEIGNANT;
    			 		}
    					if( $_POST['Dsp_Cursus'] == 'dsp_Cursus_oui')
    			 		{
    					$droits |= AFFICHER_CURSUS;
    			 		}
    					if( $_POST['Add_Cursus'] == 'add_Cursus_oui')
    			 		{
    					$droits |= AJOUTER_CURSUS;
    			 		}
    					if( $_POST['Del_Cursus'] == 'del_Cursus_oui')
    			 		{
    					$droits |= SUPPRIMER_CURSUS;
    			 		}
    					if( $_POST['Dsp_Jury'] == 'dsp_Jury_oui')
    			 		{
    					$droits |= AFFICHER_JURY;
    			 		}
    					if( $_POST['Dsp_Module'] == 'dsp_Module_oui')
    			 		{
    					$droits |= AFFICHER_MODULES;
    			 		}
    					if( $_POST['Add_Module'] == 'add_Module_oui')
    			 		{
    					$droits |= AJOUTER_MODULE;
    			 		}
    					if( $_POST['Del_Module'] == 'del_Module_oui')
    			 		{
    					$droits |= SUPPRIMER_MODULE;
    			 		}
    					if( $_POST['Upd_Module'] == 'upd_Module_oui')
    			 		{
    					$droits |= MODIFIER_MODULE;
    			 		}
    					$data = array(
    						"idPermission" => $_POST["id"],
    						"nom" => $nom,
    						"permission" => $droits
    					);
    					// On appel la fonction update avec le tableau de donnée en parametter
    					ModelGroup::update($data);
    					// L'utilisateur est renvoyé vers la vue de confirmation de modification
              $notification = "Le groupe de permission à bien était mis à jour.";
              $listGroup=ModelGroup::selectAll();
    					$view="Gestion";
    					$pagetitle="Groupe mis à jour !";
    				}
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

    		case "deletedGroup":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & SUPPRIMER_GROUPE_PERM)){
    				if (!(isset($_POST['id']))) {
    					// Si on n'a pas l'identifiant du groupe, l'utilisateur est renvoyé à la vue de gestion des groupes
    					header('Location:group.php?action=gestionGroup');
    				}
    				// On crée le tableau que l'on va envoyé pour effectué la selection dans la base de données
    				$data = array("idPermission"=>$_POST['id']);
    				// On appel la fonction de selection
    				$dataok=ModelGroup::selectWhere($data);
    				// On vérifie que le groupe avec cet identifiant existe
    				if($dataok==null){
    					// Sinon l'utilisateur est renvoyé vers la vue de gestion des groupes
    					header('Location:group.php?action=gestionGroup');
    				}
    				ModelGroup::delete($data);
    				// L'utilisateur est renvoyé vers la vue de confirmation de suppression
    				$notification = "Le groupe de permission à bien était supprimé.";
            $listGroup=ModelGroup::selectAll();
    				$view="Gestion";
    				$pagetitle="Groupe supprimé !";
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
