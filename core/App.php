<?php

class App {
    
    public function __construct() { //will automatically execute when object created
        $url = $this->parseUrl();
        
        $controllerName = "{$url[0]}Controller"; //e.g HomeController
        if (!file_exists("controllers/$controllerName.php")) //e.g HomeController.php
            return; //one line format
        require_once "controllers/$controllerName.php"; //use double quote convert variable to HomeController.php and require it into this class!!! a polymorphism example !
        $controller = new $controllerName; // === new HomeController, but come from where?
        $methodName = isset($url[1]) ? $url[1] : "index"; //if second parameter was set, means want to access method in controller, if not, goto index
        if (!method_exists($controller, $methodName)) //a built-in function in php, for test a method whether exist in a object
            return;
        unset($url[0]); unset($url[1]);
        $params = $url ? array_values($url) : Array(); //a built-in function in php, for get number index array from a exist array, or the first and second element's be unset, need to use this method to reindex
        // var_dump($params);
        call_user_func_array(Array($controller, $methodName), $params); //call $controller's $methodName with $params,for this function it become another class??
    }
    
    public function parseUrl() { // able to parse url for htaccess doc have rewrited old url into $_GET
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/"); 
            $url = explode("/", $url); //explode string into array and be warn this method can accept third parameter to limit number of elements
            return $url;
        }
    }
    
}

?>

