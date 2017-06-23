<?php

require_once ("Model.php");

// Nous définissons les constantes de droits | une constante = 1 droits
define ('AJOUTER_UTILISATEUR', 0x01);
define ('SUPPRIMER_UTILISATEUR', 0x02);
define ('AJOUTER_GROUPE_PERM', 0x04);
define ('SUPPRIMER_GROUPE_PERM', 0x08);
define ('MODIFIER_GROUPE_PERM', 0x10);
define ('AJOUTER_ETUDIANT', 0x20);
define ('SUPPRIMER_ETUDIANT', 0x40);
define ('MODIFIER_ETUDIANT', 0x80);
define ('AFFICHER_UTILISATEURS', 0x100);
define ('AFFICHER_GROUPES_PERM', 0x200);
define ('AFFICHER_ETUDIANTS', 0x400);
define ('AFFICHER_ENSEIGNANTS', 0x800);
define ('AJOUTER_ENSEIGNANT', 0x1000);
define ('SUPPRIMER_ENSEIGNANT', 0x2000);
define ('MODIFIER_ENSEIGNANT', 0x4000);
define ('AFFICHER_CURSUS', 0x8000);
define ('AJOUTER_CURSUS', 0x10000);
define ('SUPPRIMER_CURSUS', 0x20000);
define ('AFFICHER_JURY', 0x40000);
define ('AFFICHER_MODULES', 0x80000);
define ('AJOUTER_MODULE', 0x100000);
define ('SUPPRIMER_MODULE', 0x200000);
define ('MODIFIER_MODULE', 0x400000);

class ModelGroup extends Model{

  protected static $table="Permissions";
  protected static $primary_index="idPermission";

 }

 ?>
