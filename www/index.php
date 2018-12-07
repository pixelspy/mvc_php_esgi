<?php
require "./.conf.inc.php"; // contient toutes les constantes

function myAutoloader($class){
  $pathCore = "core/".$class.".class.php";
  $pathModels = "models/".$class.".class.php";
  if (file_exists($pathCore)) {
    include $pathCore;
  } else if (file_exists($pathModels)) {
    include $pathModels;
  }
}
// Appel la fonction autoLoader si on essaye une instance
// d'une class qui n'existe pas
spl_autoload_register("myAutoloader");
// s'il y a une erreur execute la function myAutoloader
// autoloader fonctionne comme le try & catch


// header("Location: http://www.google.fr");

// utilisation de la variable super globale SERVER
// SuperGlobal variable sont crées par le serveur et alimentées aussi par le serveur
// on ne doit que les consulter
// Elles commencent par $_ et sont en majuscules :
$slug = $_SERVER["REQUEST_URI"];
// echo $slug;

//////////// Logique de routing initiale :
// Découper l'url pour distinguer le controller et l' action
$slugExploded = explode('/', trim($slug, "/"));
// Suppression des GET
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];

// require "./core/Routing.class.php";
$route = Routing::getRoute($slug);
if(is_null($route)){
  die("L'url n'existe pas");
};
extract($route); // transform array in multitude variables


if (file_exists($controllerPath)) {
    // echo "Le fichier $filename existe.";
    include $controllerPath;
    // Instance du Controller
    if (class_exists($controller)) {
      $controllerObject = new $controller();

      // verification de l'existence de la methode
      if(method_exists($controllerObject, $action)) {
        // appel de la méthode
        $controllerObject->$action(); //affiche l'echo de l'action dans le Ctrl
      } else {
        die("L'action ".$action." n'existe pas.");
      }
    } else {
      die("La classe ".$controller." n'existe pas.");
    }
} else {
    die("Le fichier $controllerPath n'existe pas.");
};
