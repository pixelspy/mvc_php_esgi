<?php

class UsersController {
  public function defaultAction(){
    echo "User default";
  }

  public function registerAction(){
    $user = new Users();
    $user->setId("2");
    $user->setFirstname("laura");
    // $user->setLastname("dee");
    // $user->setEmail("maa@mail.com");
    // $user->setPwd("test");
    $user->save();
    //$user->getOneBy(["id"=>2]);

    // view userAdd , avec template front
    $v = new View("addUser", "front");
    // print_r($v);
  }
  public function loginAction(){
    $v = new View("login", "front");
  }
  public function forgetPasswordAction(){
    $v = new View("forgot-password", "front");
  }

}
