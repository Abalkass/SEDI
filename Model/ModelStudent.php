<?php

require_once ("Model.php");

class ModelStudent extends Model{

  protected static $table="Etudiant";
  protected static $primary_index="INE";

  public static function SelectAllOrderedByName() {
    try {
      $table = static::$table;
			$sql = "SELECT * FROM $table ORDER BY nom"; // requête SQL
      $req = self::$pdo->query($sql);
			$ans = $req->fetchAll(PDO::FETCH_OBJ);
			return $ans; // retourne un tableau d'objet (fetchAll)
    }
		catch (PDOException $e) {
      echo $e->getMessage();
      die();
    	}
    }


}
?>
