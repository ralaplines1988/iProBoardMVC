<?php

class Controller { // make all controllers have abilities to get their own model and view
    public function model($model) { //for child class use
        // echo "Call model!<br>";
        require_once "models/$model.php";
        return new $model ();
    }

    public function view($view, $data = Array()) { //$data = Array() is a default set
        // echo "Call view!<br>";
        require_once "views/$view.php";
    }

}

?>