<?php

class Users extends BaseSQL {

  public $id = null;
  public $firstname;
  public $lastname;
  public $email;
  public $pwd;
  public $status = 0;
  public $role = 1;

  public function __construct() {
    parent::__construct();
  }

// SETTERS :
// on ne verifie pas les données, on les formatte
  public function setId($id){
    $this->id = $id;
    // Alimentation de l'objet (this) depuis la bdd où l'id corresponds
    $this->getOneBy(["id"=>$id]);
  }
  public function setFirstname($firstname){
    $this->firstname = ucwords(strtolower(trim($firstname)));
// ucwords : tous les 1eres lettres de chaque mot en Majuscule
  }
  public function setLastname($lastname){
    $this->lastname = strtoupper(trim($lastname));
// strtoupper toutes les lettres en majuscules
  }
  public function setEmail($email){
    $this->email = strtolower(trim($email));
  }
  public function setPwd($pwd){
    $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
// PASSWORD_DEFAULT : constante PHP
  }
  public function setStatus($status){
    $this->status = $status;
  }
  public function setRole($role){
    $this->role = $role;
  }
}

// GETTERS :
