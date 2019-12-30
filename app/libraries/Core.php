<?php 
/*
  * App Core Class - creates url & loads core controller
  * URL format - /controller/method/params
*/

class Core {
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct(){
    //set var to getUrl
    $url = $this->getUrl();
    //look in controllers for first value[0] for controller
    if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
      //if exists then set as current controller
      $this->currentController = ucwords($url[0]);
      //unset zero index
      unset($url[0]);
    }

    //require the controller and instantiate it
    require_once '../app/controllers/'. $this->currentController . '.php';
    $this->currentController = new $this->currentController;
  }

  //check that url is set - isset funct
  //trim trailing slash if present - rtrim funct
  //sanitize as url - filter_var funct
  //break into array - explode funct
  public function getUrl(){
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    } 
  }
}
