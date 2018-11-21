<?php

class View{
  private $v;
  private $t;
  private $data;

  public function __construct($v, $t="back"){
    // $v = view ,  $t = template
    $this->setView($v);
    $this->setTemplate($t);
  }

// on crée les Setters :
// pour formatter nos attributs d'objets : notre data

  public function setView($v){
    $pathView = "views/".$v.".view.php";
    if (file_exists($pathView)){
      $this->v = $pathView;
    } else {
      	die("La vue ".$pathView." n'existe pas");
    }
  }

  public function setTemplate($t){
    $pathTemplate = "views/templates/".$t.".tpl.php";
    if (file_exists($pathTemplate)){
      $this->t = $pathTemplate;
    } else {
      die("Le Template n'existe pas : ".$pathTemplate);
    }
  }

  // function assign to pass data variable in our views :
  // clé : pseudo, valeur: prof
  public function assign($key, $value){
    $this->data[$key] = $value;
    // Exemple : $this->data = ["pseudo" => "prof", "name" => "maa"]
  }

// toutes les classes instanciées, se détruisent ici :
  public function __destruct(){
    if(isset($this->data)) {
      extract($this->data); // Extract donne :
      // $pseudo = "prof";
      // $name = "maa"
    }; // to separate an array into different variables
    // we need it here because data is an array !
    include $this->t;
  }
}
