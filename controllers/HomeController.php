<?php

class HomeController extends Controller { // inherit from Controller class to be able to use method from parent
    
    function index() {
        echo "home page of HomeController";
        $this->view("Home/index");
    }
    
    function hello($name,$number) { //use specific method to get specific data and method
        $user = $this->model("User"); //access to method of controller, use model method to get specific model
        var_dump($user);
        $user->name = $name;
        $user->number = $number;
        $this->view("Home/hello", $user); //access to method of controller
        // echo "Hello! $user->name";
    }
    
}

?>