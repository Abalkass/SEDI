<?php

class Security {
  private static $seed = 'seedsedi';

  static public function getSeed() {
    return self::$seed;
  }

  /*
  /* Génération d'un mot de passe aléatoire
  */
  static public function generateMDP ($nb_caractere = 8){
    $mot_de_passe = "";

          $chaine = "abc0123";
          $longeur_chaine = strlen($chaine);

          for($i = 1; $i <= $nb_caractere; $i++)
          {
              $place_aleatoire = mt_rand(0,($longeur_chaine-1));
              $mot_de_passe .= $chaine[$place_aleatoire];
          }

          return $mot_de_passe;
    }

}


?>
