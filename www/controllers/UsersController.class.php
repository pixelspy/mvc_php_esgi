<?php

class UsersController {
  public function defaultAction(){
    echo "User default";
  }
  public function registerAction(){


    $user = new Users();
    // $user->setEmail("maa@mail.com")
    // $user->setFirstname("mahana")
    // $user->setLastname("dee")
    // $user->setPassword("test")
    // $user->save();

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
