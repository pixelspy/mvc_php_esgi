<?php

class BaseSQL {
  private $db;
  private $table;
  private $columns = [];

  public function __construct(){
    // Mettre en place le SINGLETON pour le projet MVC :
    // éviter d'avoir multiple connexion sql à chaque fois qu'on fait une requete !!

    try {
      $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
      // driver (le nom de systeme de bdd) : mysql
      // host = database parcequ'on est sur docker, et non pas localhost
    } catch(Exception $e) {
      die("Erreur SQL : ".$e->getMessage());
    }

    // Récupérer la table de manière dynamique:
    $this->table = get_called_class();
    //echo $this->table;
  }



  // dynamique grace avec les attributs définis dans les models
  // va créé un create and update
public function getColumns(){
  // Récupérer les colonnes de la table de manière dynamique
  $objectVars = get_object_vars($this);
  $classVars = get_class_vars(get_class());
  $columns = array_diff_key($objectVars, $classVars);
  return $columns;
}
// Dynamique en fonction de l'enfant qui en hérite
  public function save(){
    $columns = $this->getColumns();

    //print_r($columns);

    if (is_null($columns["id"])) {
      // if id is NULL -> CREATE

      $sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).")
          VALUES (:".implode(",:", array_keys($columns)).")";
          //echo $sql;
      $query = $this->db->prepare($sql);
      $query->execute( $columns );

    } else {
      // if id isn't NULL -> UPDATE
        foreach ($columns as $key => $value) {
          $sqlSet[] = $key . "=:" . $key;
        }

        //print_r($sqlSet);

        $sql = "UPDATE " . $this->table . " SET
          " .implode(",", $sqlSet) . "
          WHERE id=:id;";

        //echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute( $columns );

    }
  }

// Example : $where= ["id"=>3]
  public function getOneBy(array $where){
    //print_r($where);
    foreach ($where as $key => $value) {
      $sqlWhere[] = $key . "=:" . $key;
    }

    $sql = "SELECT * FROM " . $this->table . " WHERE
      " .implode(" AND ", $sqlWhere);
    //echo $sql;
    $query = $this->db->prepare($sql);
    $query->execute( $where );

    echo "<pre>";
    //$query->setFetchMode(PDO::FETCH_CLASS, $this->table);
    $query->setFetchMode(PDO::FETCH_INTO, $this);

    // PDO can't acess to protected attributs of child.
    // We have to put them in public
    $query->fetch();
    print_r($this);
  }
}

