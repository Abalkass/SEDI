<?php

  require_once MODEL_PATH."ModelStudent.php";
  require_once MODEL_PATH."ModelEstStudent.php";
  require_once MODEL_PATH."ModelGroup.php";
  require_once MODEL_PATH."ModelUE.php";
  require_once MODEL_PATH."ModelCursus.php";
  require_once MODEL_PATH."ModelNoteUE.php";

  // Fonction qui recupère les données d'une colonne d'un csv dans un array()
  function dataColumn($file_path, $numColumn) {
  $ligne = 0;
  $tab = array();
  if (($handle = fopen("$file_path", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
          $num = count($data);
          $tab[$ligne] = $data[$numColumn];
          $ligne++;
      }
      fclose($handle);
  }
  return $tab;
  }

  if(!estConnecte()) {
    $messageErreur="Vous n'êtes pas connecté! Veuillez vous connecté!";
  }
  else {
    if (empty($_GET)){
      header('Location:.');
    }
    else if (isset($action)){
      switch ($action) {

        //-----Gestion des Etudiants-----
    		case "gestionStudent":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AFFICHER_ETUDIANTS)){
    				// On récupere la liste des étudiant avec un selectall()
    				$listStudents=ModelStudent::selectAll();
            $notification = NULL;
    				// l'utilisateur est renvoyé vers la vue de gestion des etudiants
    				$view="Gestion";
    				$pagetitle="Gestion des étudiants";
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

        case "addStudent":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
    				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
    				$action='add';
    				$view="AddUpd";
    				$pagetitle="Ajout d'un étudiant";
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    		break;

        case "addedStudent":
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
    				// On vérifie que l'utilisateur a bien saisi tout les données necessaires
    				if (!(isset($_POST['INE']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['commune']) )) {
    						header('Location:student.php?action=addStudent');
    				}
    				// Il faut vérifier les données en plus du html
    				// Vérification de l'INE
    				if(!(preg_match("/^[0-9a-z]{11}$/i",$_POST['INE']) && strlen($_POST['INE']) == 11)){
    					$messageErreur="Vous n'avez pas saisi un INE valide !";
    					break;
    				}
    				// Vérification de l'email
    				if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    					$messageErreur="Vous n'avez pas saisi un e-mail valide !";
    					break;
    				}
    				// Vérification du code postal
    				if(!(preg_match("/^[0-9]{5}$/i",$_POST['code_postal']) && strlen($_POST['code_postal']) == 5)){
    					$messageErreur="Vous n'avez pas saisi un code postal valide !";
    					break;
    				}
    				// Vérification du téléphone fixe s'il à été saisi
    				if (!empty($_POST['tel_fixe'])) {
    					if(!(preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}$/i",$_POST['tel_fixe']) && strlen($_POST['tel_fixe']) == 14)){
    						$messageErreur="Vous n'avez pas saisi un numéro de téléphone valide !";
    						break;
    					}
    				}
    				// Vérification du téléphone portable s'il à été saisi
    				if (!empty($_POST['tel_portable'])) {
    					if(!(preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}$/i",$_POST['tel_portable']) && strlen($_POST['tel_portable']) == 14)){
    						$messageErreur="Vous n'avez pas saisi un numéro de téléphone valide !";
    						break;
    					}
    				}
    				// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
    				$data = array(
    					"INE" => strtolower($_POST["INE"]), // On récupere les valeur en lettres minuscules
    					"nom" => strtolower($_POST["nom"]),
    					"prenom" => strtolower($_POST["prenom"]),
    					"date_naissance" => $_POST["date_naissance"],
    					"email" => strtolower($_POST["email"]),
    					"adresse" => strtolower($_POST["adresse"]),
    					"complement_adresse" => strtolower($_POST["complement_adresse"]),
    					"code_postal" => $_POST["code_postal"],
    					"commune" => strtolower($_POST["commune"]),
    					"pays" => strtolower($_POST["pays"]),
    					"tel_fixe" => $_POST["tel_fixe"],
    					"tel_portable" => $_POST["tel_portable"]
    				);
    				// On crée un tableau avec les valeurs du formulaire que l'ont veut vérifier dans la base de données (ici l'INE)
    				$dataCheck = array(
    			 "INE" => $_POST["INE"]
    				);
    				// On effectue la selection dans la baes de donnée
    				$Studentexist = ModelStudent::selectWhere($dataCheck);
    				// S'il exite déja un étudiant avec cet INE
    			  if ($Studentexist != null) {
    				 $messageErreur="Cet étudiant est déja dans la base de données!";
    			  }
    				else {
    					// On effectue l'insertion dans la base de donnée
    					ModelStudent::insert($data);
              $notification = "L'étudiant à bien était ajouté";
              // On récupere la liste des étudiant avec un selectall()
      				$listStudents=ModelStudent::selectAll();
    					$view="Gestion";
    					$pagetitle="Etudiant ajouté";
    				}
    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    			break;

          case"updateStudent":
    				// On vérifie que l'utilisateur à les droits necessaires
    				if (((int)$_SESSION['droits'] & MODIFIER_ETUDIANT)){
    					// Si on pas l'id de l'étudiant, l'utilisateur est renvoyé à la vue de gestion des Etudiants
    					if (!(isset($_POST['id']))) {
    						header('Location:student.php?action=gestionStudent');
    					}
    					// On crée le tableau avec l'id de la permission pour faire la selection dans la base de données
    					$data = array("INE"=>$_POST['id']);
    					// On appel la fonction de selection
    					$student = ModelStudent::select($data);
    					$INE = $_POST['id'];
    					$nom = $student->nom;
    					$prenom = $student->prenom;
    					$date_naissance = $student->date_naissance;
    					$email = $student->email;
    					$adresse = $student->adresse;
    					$complement_adresse = $student->complement_adresse;
    					$code_postal = $student->code_postal;
    					$commune = $student->commune;
    					$pays = $student->pays;
    					$tel_fixe = $student->tel_fixe;
    					$tel_portable = $student->tel_portable;
    					$action='updat';
    					$view="AddUpd";
    					$pagetitle="Modification d'un étudiant";
    				}
    				// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    				else {
    					$view="restricted";
    					$pagetitle="Accès interdit";
    				}
    			break;

          case"updatedStudent": // averif si on veut modif l'INE
    			// On vérifie que l'utilisateur à les droits necessaires
    			if (((int)$_SESSION['droits'] & MODIFIER_ETUDIANT)){
    				// On vérifie que l'utilisateur a bien saisi tout les données necessaires
    				if (!(isset($_POST['INE']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['commune']) )) {
    						header('Location:student.php?action=updateStudent');
    				}
    				// Il faut vérifier les données en plus du html
    				// Vérification de l'INE
    				if(!(preg_match("/^[0-9a-z]{11}$/i",$_POST['INE']) && strlen($_POST['INE']) == 11)){
    					$messageErreur="Vous n'avez pas saisi un INE valide !";
    					break;
    				}
    				// Vérification de l'email
    				if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    					$messageErreur="Vous n'avez pas saisi un e-mail valide !";
    					break;
    				}
    				// Vérification du code postal
    				if(!(preg_match("/^[0-9]{5}$/i",$_POST['code_postal']) && strlen($_POST['code_postal']) == 5)){
    					$messageErreur="Vous n'avez pas saisi un code postal valide !";
    					break;
    				}
    				// Vérification du téléphone fixe s'il à été saisi
    				if (!empty($_POST['tel_fixe'])) {
    					if(!(preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}$/i",$_POST['tel_fixe']) && strlen($_POST['tel_fixe']) == 14)){
    						$messageErreur="Vous n'avez pas saisi un numéro de téléphone valide !";
    						break;
    					}
    				}
    				// Vérification du téléphone portable s'il à été saisi
    				if (!empty($_POST['tel_portable'])) {
    					if(!(preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}$/i",$_POST['tel_portable']) && strlen($_POST['tel_portable']) == 14)){
    						$messageErreur="Vous n'avez pas saisi un numéro de téléphone valide !";
    						break;
    					}
    				}
    				// On crée le tableau avec les valeurs du formulaire que l'ont va inséré dans la base de données
    				$data = array(
    					"INE" => strtolower($_POST["INE"]), // On récupere les valeur en lettres minuscules
    					"nom" => strtolower($_POST["nom"]),
    					"prenom" => strtolower($_POST["prenom"]),
    					"date_naissance" => $_POST["date_naissance"],
    					"email" => strtolower($_POST["email"]),
    					"adresse" => strtolower($_POST["adresse"]),
    					"complement_adresse" => strtolower($_POST["complement_adresse"]),
    					"code_postal" => $_POST["code_postal"],
    					"commune" => strtolower($_POST["commune"]),
    					"pays" => strtolower($_POST["pays"]),
    					"tel_fixe" => $_POST["tel_fixe"],
    					"tel_portable" => $_POST["tel_portable"]
    				);

    					ModelStudent::update($data);
              $notification = "L'étudiant à bien était mis à jour";
              // On récupere la liste des étudiant avec un selectall()
      				$listStudents=ModelStudent::selectAll();
    					$view="Gestion";
    					$pagetitle="Etudiant mis à jour !";

    			}
    			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    			else {
    				$view="restricted";
    				$pagetitle="Accès interdit";
    			}
    			break;

          case "deletedStudent":
    				// On vérifie que l'utilisateur à les droits necessaires
    				if (((int)$_SESSION['droits'] & SUPPRIMER_ETUDIANT)){
    					// Si on n'a pas l'identifiant de l'étudiant lors de l'envoie du formulaire
    					if (!(isset($_POST['id']))) {
    						// L'utilisateur est renvoyé à la gestion des étudiant
    						header('Location:student.php?action=gestionStudent');
    					}
    					// On crée le tableau avec l'INE de l'étudiant
    					$data = array("INE"=>$_POST['id']);
    					// On appel la fonction de selection
    					$donneesok=ModelStudent::selectWhere($data);
    					// On vérifie que la selection renvoie bien quelque chose
    					if($donneesok==null){
    						// Sinon l'utilisateur et renvoyé la la vue de gestion des étudiant
    						header('Location:student.php?action=gestionStudent');
    					}
    					// On effectue la suppression avec la fonction delete()
    					ModelStudent::delete($data);
    					// l'utilisateur est renvoyé vers la vue de confirmation de suppression
              $notification = "L'étudiant à bien était supprimé";
              // On récupere la liste des étudiant avec un selectall()
      				$listStudents=ModelStudent::selectAll();
    					$view="Gestion";
    					$pagetitle="Etudiant supprimé !";
    				}
    				// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
    				else {
    					$view="restricted";
    					$pagetitle="Accès interdit";
    				}
    			break;

          case "loadCSVStudent":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
      				$view="LoadCSV";
      				$pagetitle="Chargement du CSV";
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "selectColumnCSV":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
      				if (!empty($_FILES['CSV_File']) && is_uploaded_file($_FILES['CSV_File']['tmp_name'])) { //ok
      					$name = $_FILES['CSV_File']['name'];
      					$file_path = "upload/".$name;
      					if (!move_uploaded_file($_FILES['CSV_File']['tmp_name'], $file_path)) {
        					echo "La copie a échoué";
      					}
      					$view="SelectColumnCSV";
      					$pagetitle="Selection des colonnes à importer";
      				}
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "checkCSVStudent":
            // On vérifie que l'utilisateur à les droits necessaires
    			  if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
    				  // On vérifie que l'utilisateur a bien saisi tout les données necessaires
    				  if (!(isset($_POST['colonneINE']) && isset($_POST['colonneNom']) && isset($_POST['colonnePrenom']) && isset($_POST['colonneBirthday']) && isset($_POST['colonneMail']) && isset($_POST['colonneAdress']) && isset($_POST['colonneCpltAdress']) && isset($_POST['colonneCodeP']) && isset($_POST['colonneCommune']) && isset($_POST['colonneState']) && isset($_POST['colonneTelF']) && isset($_POST['colonneTelP']) )) {
    						header('Location:student.php?action=selectColumnCSV');
    				  }
              // chemin du fichier
              $file_path = $_POST['File_CSV'];
              // tableau des num de colonnes à inserer
              $data = array(
                "colonneINE"=>$_POST['colonneINE'],
      					"colonneNom"=>$_POST['colonneNom'],
      					"colonnePrenom"=>$_POST['colonnePrenom'],
      					"colonneBirthday"=>$_POST['colonneBirthday'],
      					"colonneMail"=>$_POST['colonneMail'],
      					"colonneAdress"=>$_POST['colonneAdress'],
      					"colonneCpltAdress"=>$_POST['colonneCpltAdress'],
      					"colonneCodeP"=>$_POST['colonneCodeP'],
      					"colonneCommune"=>$_POST['colonneCommune'],
      					"colonneState"=>$_POST['colonneState'],
      					"colonneTelF"=>$_POST['colonneTelF'],
      					"colonneTelP"=>$_POST['colonneTelP']
              );
              $colonneINE = dataColumn($file_path, $_POST['colonneINE']);
              $colonneNom = dataColumn($file_path, $_POST['colonneNom']);
              $colonnePrenom = dataColumn($file_path, $_POST['colonnePrenom']);
      				// l'utilisateur est renvoyé vers la vue de gestion des etudiants
      				$view="CheckCSV";
      				$pagetitle="Vérification des données";
            }
            // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
            else {
              $view="restricted";
              $pagetitle="Accès interdit";
            }
          break;

          case "addedCSVStudent":
          ini_set('display_errors',1);
            if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
              if (!(isset($_POST['colonneINE']) && isset($_POST['colonneNom']) && isset($_POST['colonnePrenom']) && isset($_POST['colonneBirthday']) && isset($_POST['colonneMail']) && isset($_POST['colonneAdress']) && isset($_POST['colonneCpltAdress']) && isset($_POST['colonneCodeP']) && isset($_POST['colonneCommune']) && isset($_POST['colonneState']) && isset($_POST['colonneTelF']) && isset($_POST['colonneTelP']) )) {
    						header('Location:student.php?action=selectColumnCSV');
    				  }
              // chemin du fichier
              $file_path = $_POST['File_CSV'];
              // Récupération des données de chaque colonne
              $colonneINE = dataColumn($file_path, $_POST['colonneINE']);
              $colonneNom = dataColumn($file_path, $_POST['colonneNom']);
              $colonnePrenom = dataColumn($file_path, $_POST['colonnePrenom']);
              $colonneMail = dataColumn($file_path, $_POST['colonneMail']);
              $colonneBirthday = dataColumn($file_path, $_POST['colonneBirthday']);
              $colonneAdress = dataColumn($file_path, $_POST['colonneAdress']);
              $colonneCpltAdress = dataColumn($file_path, $_POST['colonneCpltAdress']);
              $colonneCodeP = dataColumn($file_path, $_POST['colonneCodeP']);
              $colonneCommune = dataColumn($file_path, $_POST['colonneCommune']);
              $colonneState = dataColumn($file_path, $_POST['colonneState']);
              $colonneTelF = dataColumn($file_path, $_POST['colonneTelF']);
              $colonneTelP = dataColumn($file_path, $_POST['colonneTelP']);

              for ($c=1; $c < count($colonneINE); $c++) {
                $data = array(
        					"INE" => strtolower($colonneINE[$c]), // On récupere les valeur en lettres minuscules
        					"nom" => strtolower($colonneNom[$c]),
        					"prenom" => strtolower($colonnePrenom[$c]),
        					"date_naissance" => $colonneBirthday[$c],
        					"email" => strtolower($colonneMail[$c]),
        					"adresse" => strtolower($colonneAdress[$c]),
        					"complement_adresse" => strtolower($colonneCpltAdress[$c]),
        					"code_postal" => $colonneCodeP[$c],
        					"commune" => strtolower($colonneCommune[$c]),
        					"pays" => strtolower($colonneState[$c]),
        					"tel_fixe" => $colonneTelP[$c],
        					"tel_portable" => $colonneTelF[$c]
        				);
                // On crée un tableau avec les valeurs du formulaire que l'ont veut vérifier dans la base de données (ici l'INE)
                $dataCheck = array(
                  "INE" => strtolower($colonneINE[$c])
                );
                // On effectue la selection dans la baes de donnée
                $Studentexist = ModelStudent::selectWhere($dataCheck);
                // S'il exite déja un étudiant avec cet INE
                if ($Studentexist != null) {
                  // Si l'etudiant existe déja, il est mis a jours
                  ModelStudent::update($data);
                }
                else {
                  // Sinon, il est inseré
                  ModelStudent::insert($data);
                }
              }
              $notification = "Les étudiants ont bien était ajoutés";
              // On récupere la liste des étudiant avec un selectall()
      				$listStudents=ModelStudent::selectAll();
              $view="Gestion";
    					$pagetitle="Etudiants ajoutés!";
            }
            // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
            else {
              $view="restricted";
              $pagetitle="Accès interdit";
            }
          break;

          case "loadCSVNote":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
              $listCursus=ModelCursus::selectAll();
      				$view="LoadCSVNote";
      				$pagetitle="Chargement du CSV";
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "selectColumnCSVNote":
          ini_set('display_errors',1);
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
      				if (!empty($_FILES['CSV_File']) && is_uploaded_file($_FILES['CSV_File']['tmp_name'])) { //ok
      					$name = $_FILES['CSV_File']['name'];
      					$file_path = "upload/".$name;
      					if (!move_uploaded_file($_FILES['CSV_File']['tmp_name'], $file_path)) {
        					echo "La copie a échoué";
      					}
                $data = array(
    							"idCursus" => $_POST["cursus"]
    						);
                $cursus = $_POST["cursus"];
                $UECursus = ModelUE::selectWhere($data);
                $nbUECursus = sizeof($UECursus);
      					$view="SelectColumnCSVNote";
      					$pagetitle="Selection des colonnes à importer";
      				}
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "addedCSVNote":
          ini_set('display_errors',1);
            if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
              if (!(isset($_POST['colonneNom']) && isset($_POST['colonnePrenom']) && isset($_POST['colonneUE1']) && isset($_POST['colonneUE2']) && isset($_POST['colonneUE3']) )) {
    						header('Location:student.php?action=selectColumnCSV');
    				  }
              // chemin du fichier
              $file_path = $_POST['File_CSV'];
              $cursus = $_POST["cursus"];
              $nbUECursus = $_POST["nbUECursus"];
              // Récupération des données de chaque colonne
              $colonneNom = dataColumn($file_path, $_POST['colonneNom']);
              $colonnePrenom = dataColumn($file_path, $_POST['colonnePrenom']);
              $colonneUE1 = dataColumn($file_path, $_POST['colonneUE1']);
              $colonneUE2 = dataColumn($file_path, $_POST['colonneUE2']);

              for ($c=1; $c < count($colonneNom); $c++) {
                $dataCheck = array(
                  "nom" => strtolower($colonneNom[$c]),
                  "prenom" => strtolower($colonnePrenom[$c])
                );
                $Student = ModelStudent::selectWhere($dataCheck);

                  for ($i=1; $i <= $nbUECursus; $i++) {
                    $data2 = array(
                      "idUE" => "UE".$i."_".$cursus."",
        					    "INE" => $Student[0]->INE,
        					    "moyenne" => strtolower(${'colonneUE'.$i}[$c])
        				      );
                      ModelNoteUE::insert($data2);
                  }

              }
              $notification = "Les notes ont été ajoutés";
              // On récupere la liste des étudiant avec un selectall()
      				$listStudents=ModelStudent::selectAll();
              $view="Gestion";
    					$pagetitle="Etudiants ajoutés!";
            }
            // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
            else {
              $view="restricted";
              $pagetitle="Accès interdit";
            }
          break;

          case "checkCSVNote":
            // On vérifie que l'utilisateur à les droits necessaires
    			  if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
              // chemin du fichier
              $file_path = $_POST['File_CSV'];
              $cursus = $_POST["cursus"];
              // tableau des num de colonnes à inserer
              $nbUECursus = $_POST['nbUECursus'];
              $colNom = $_POST['colonneNom'];
              $colPrenom = $_POST['colonnePrenom'];
              if( $nbUECursus == 1 ) {
                $UE1 = $_POST['UE1'];
              }
              else if ($nbUECursus == 2){
                $UE1 = $_POST['UE1'];
                $UE2 = $_POST['UE2'];
              }
              else if ($nbUECursus == 3){
                $UE1 = $_POST['UE1'];
                $UE2 = $_POST['UE2'];
                $UE3 = $_POST['UE3'];
              }

              $colonneNom = dataColumn($file_path, $_POST['colonneNom']);
              $colonnePrenom = dataColumn($file_path, $_POST['colonnePrenom']);
      				// l'utilisateur est renvoyé vers la vue de gestion des etudiants
      				$view="CheckCSVNote";
      				$pagetitle="Vérification des données";
            }
            // Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
            else {
              $view="restricted";
              $pagetitle="Accès interdit";
            }
          break;

          case "addStudentCursus":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
              $listCursus=ModelCursus::selectAll();
      				$view="AddToCursus";
      				$pagetitle="Selection du cursus";
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "selectStudentToAffect":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
              $cursus = $_POST['cursus'];
              $listStudent=ModelStudent::SelectAllOrderedByName();
      				$view="ToAffect";
      				$pagetitle="Selection des étudiants à affecter";
      			}
      			// Si l'utilisateur n'a pas les droits il est renvoyé vers la vue restricted
      			else {
      				$view="restricted";
      				$pagetitle="Accès interdit";
      			}
      		break;

          case "affectedStudent":
      			// On vérifie que l'utilisateur à les droits necessaires
      			if (((int)$_SESSION['droits'] & AJOUTER_ETUDIANT)){
      				// L'utilisateur est renvoyé vers le formulaire d'ajout d'étudiants
              $cursus = $_POST['cursus'];
              // Le tableau $_POST['prenom'] contient les valeurs des checkbox cochées
              foreach($_POST['INE'] as $valeur)
              {
                $data = array(
                  "INE" => $valeur,
    							"idCursus" => $_POST["cursus"]
    						);
                ModelEstStudent::insert($data);
              }
              $listStudents=ModelStudent::selectAll();
      				$view="Gestion";
      				$pagetitle="Etudiants Affectés";
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
