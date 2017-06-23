<?php

  require_once MODEL_PATH."ModelStudent.php";
  require_once MODEL_PATH."ModelTeacher.php";

  if(!estConnecte()) {
    $messageErreur="Vous n'êtes pas connecté! Veuillez vous connecté!";
  }
  else {
    if (empty($_GET)){
      $listEtudiants=ModelStudent::selectAll();
      $listTeachers=ModelTeacher::selectAll();
      $view="defaut";
      $pagetitle="Bienvenue";
    }
    else if (isset($action)){
      switch ($action) {

      }
    }
    else {
      header('Location:.');
    }
  }

require VIEW_PATH."view.php";

?>
