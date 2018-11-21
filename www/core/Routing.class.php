<?php

class Routing {
  public static $routeFile = "routes.yml";

  public static function getRoute($slug){

    $routes = yaml_parse_file(self::$routeFile);
    // echo "<pre>";
    // print_r($routes);
    // echo "</pre>";

    //est ce que la route existe ?
    if( !empty($routes[$slug]) ){

      // print_r($slugExploded);
      if( empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"])){
        die("Il y a une erreur dans le fichier routes");
      }
      // ajout des suffixes
      $controller = ucfirst( $routes[$slug]["controller"])."Controller";
      $action = $routes[$slug]["action"]."Action" ;

      // verifier que la class controller existe
      $controllerPath = './controllers/'.$controller.'.class.php';
    } else {
      //aucune route ne correspond
      return null;
    }
    return [
      "controller"=>$controller,
      "action"=>$action,
      "controllerPath"=>$controllerPath
    ];
  }

// Routes dynamiques : 
public static function getSlug($controller=null, $action=null){
  // fonction inverse de celle de dessus
  $routes = yaml_parse_file(self::$routeFile);
  foreach ($routes as $slug => $cAnda) {
    if (
      !empty($cAnda["controller"]) &&
      !empty($cAnda["action"] ) &&
      $cAnda["controller"] == $c &&
      $cAnda["action"] == $a
    ){
      return $slug;
    }
  }
  return null;
}
}
