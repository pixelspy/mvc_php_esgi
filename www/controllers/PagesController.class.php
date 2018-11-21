<?php

class PagesController {
  function defaultAction(){
    $v = new View("homepage", "back");

    // $pseudo = "Pixelspy";
    // $v = new View("homepage", "front");
    // // (nom de la variable, valeur)
    // $v->assign("pseudo", $pseudo);
  }
}
