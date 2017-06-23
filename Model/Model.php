<?php

require_once ROOT . DS . 'Conf' . DS . 'Conf.php';

class Model {

	public static $pdo;

	public static function Init(){
		$host = Conf::getHostname();
		$dbname = Conf::getDatabase();
		$login = Conf::getLogin();
		$pass = Conf::getPassword();
		try{
			// Connexion à la base de données
			// Le dernier argument sert à ce que toutes les chaines de caractères
			// en entrée et sortie de MySql soit dans le codage UTF-8
  			self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
  			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
  			echo $e->getMessage(); // affiche un message d'erreur
  		die();
		}
	}

	// Méthode Générique pour la selection de tous les élément d'un table
	public static function SelectAll() {
    try {
			$sql = "SELECT * FROM ".static::$table; // requête SQL
      $req = self::$pdo->query($sql);
			$ans = $req->fetchAll(PDO::FETCH_OBJ);
			return $ans; // retourne un tableau d'objet (fetchAll)
    }
		catch (PDOException $e) {
      echo $e->getMessage();
      die();
    	}
    }

		public static function select($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "SELECT * FROM $table WHERE $table.$primary = :$primary";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);

            if ($req->rowCount() != 0)
                return $req->fetch(PDO::FETCH_OBJ);
            return null;  // Optionel : si return est omis, Php envoie null dans tous les cas
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la BDD " . static::$table);
        }
    }

		public static function selectWhere($data) {
	        try {
	            $table = static::$table;
	            $primary = static::$primary_index;
	            $where = "";
	            foreach ($data as $key => $value)
	                $where .= " $table.$key=:$key AND";
	            $where = rtrim($where, 'AND');
	            $sql = "SELECT * FROM $table WHERE $where";
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

			public static function delete($data) {
	        try {
	            $table = static::$table;
	            $primary = static::$primary_index;
	            $sql = "DELETE FROM $table WHERE $table.$primary = :$primary";
	            // Preparation de la requete
	            $req = self::$pdo->prepare($sql);
	            // execution de la requete
	            return $req->execute($data);
	        } catch (PDOException $e) {
	            echo $e->getMessage();
	            die("Erreur lors de la suppression dans la BDD " . static::$table);
	        }
	    }

		public static function insert($data) {
        try {
            $table = static::$table;
            $indices = "";
            $values = "";
            foreach ($data as $key => $value) {
                $indices .= "$key, ";
                $values .= ":$key, ";
            }
            $indices = '(' . rtrim($indices, ', ') . ')';
            $values = '(' . rtrim($values, ', ') . ')';
            $sql = "INSERT INTO $table $indices VALUES $values";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return self::$pdo->lastInsertId(); // On retourne le dernier id insérer dans la BDD sur cette session
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de l'insertion dans la BDD " . static::$table);
        }
    }

		public static function update($data) {
		try {
				$table = static::$table;
				$primary = static::$primary_index;

				$update = "";
				foreach ($data as $key => $value)
						$update .= "$key=:$key, ";
				$update = rtrim($update, ', ');
				$sql = "UPDATE $table SET $update WHERE $primary=:$primary";

				// Preparation de la requete
				$req = self::$pdo->prepare($sql);
				// execution de la requete
				return $req->execute($data);
		} catch (PDOException $e) {
				echo $e->getMessage();
				die("Erreur lors de la mise à jour dans la BDD " . static::$table);
		}
}

}
Model::Init();

?>
