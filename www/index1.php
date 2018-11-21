<?php

// header("Location: http://www.google.fr");

// comment récupérer le slug
// utilisation de la variable super globale SERVER
// SuperGlobal variable sont créer par le serveur et alimenté aussi par le serveur
// on en doit que les consulter
// Elles commentcent par $_ et sont en majuscules :
//
$slug = $_SERVER["REQUEST_URI"];
echo $slug;
//
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";

//

class Maison {

  //Attributs :
  public $fundation=1;
  public $roof=1;
  public $wall=4;
  public $door=1;
  public $window=0;
  public $floor=0;

  //Methods
  public function addFloor(){
    $this->floor++;
    $this->window++;
    $this->wall+=4;
  }
}
$maMaison1 = new Maison();
$maMaison1->addfloor();

print_r($maMaison1);

class BaseSql {
  public function save(){

  }
}

class User extends BaseSql { // extends : pour hériter des méthodes d'une autre class

  //Attributs :
  public $firstname;
  public $lastname;
  public $email;
  public $pwd;

  //Methods :
  // SET / GET
  public function setFirstname($firstname){
    // pour formatter nos attributs d'objets : notre data
    $this->firstname = ucwords(strtolower(trim($firstname)));
  }
  public function setLastname($lastname){
    $this->lastname = strtoupper(trim($lastname));
  }

  //Fonctions Magiques :
  // appellée automatiquement : constructor
  // new User --> le constructor de User est utilisé
  public function __construct($firstname, $lastname){
    $this->firstname = ucwords(strtolower(trim($firstname)));
    $this->lastname = strtoupper(trim($lastname));
  }
}

// Sans le constructor :
// $myUser = new User();
// $myUser->setFirstname("maa");
// // $myUser->lastname = "Dee";
// $myUser->setLastname("dee");
// print_r($myUser);

// Grace au Construcor :
$myUser2 = new User("Linus", "Carlson");
$myUser2->save();
print_r($myUser2);
