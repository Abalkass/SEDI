<?php

require_once ("Model.php");

class ModelEstStudent extends Model{

  protected static $table="Est_Etudiant";
  protected static $primary_index="INE";

  public static function selectStudentCursus($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $where = "";
            foreach ($data as $key => $value)
                $where .= " $table.$key=:$key AND";
            $where = rtrim($where, 'AND');
            $sql = "SELECT * FROM $table INNER JOIN Etudiant et ON $table.INE = et.INE WHERE $where";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la BDD " . static::$table);
        }
    }

}
?>
