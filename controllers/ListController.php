<?php

class ListController extends Controller { // inherit from Controller class to be able to use method from parent
    
    private $loginMember;
    private $db_link;

    function __construct(){
        session_start();
        require_once("db_connect.php");
        // $_SESSION["loginMember"] = "Admin";
        // unset($_SESSION["loginMember"]);
        // $this->cssPath = $_SERVER["SCRIPT_FILENAME"];
        // $MVCpos = strpos($this->cssPath, 'MVC');
        if(isset($_SESSION['loginMember']) && $_SESSION['loginMember'] !==''){
            $this->loginMember = $_SESSION['loginMember'];
        } else {
            $this->loginMember = 'Guest';
        }
    }

    function index() {
        // echo "home page of ListController";
        $this->view("List/index", $this->loginMember);
    }
    
    // function hello($name) { //use specific method to get specific data and method
    //     $user = $this->model("User"); //access to method of controller, use model method to get specific model
    //     $user->name = $name;
    //     $this->view("Home/hello", $user); //access to method of controller
    //     // echo "Hello! $user->name";
    // }
    function browse($num_pages=1){
        // echo "browse page of ListController";
        if(isset($_SESSION["loginMember"])){
            header("Location: /mvc/list/admin");
        }
        $limit_records=5;   
        $queryResult = $this->model("QueryResult");
        $queryResult->num_pages = $num_pages;
        // var_dump($queryResult);

        $startRow_records = ($num_pages -1) * $limit_records;
        $query_RecBoard = "SELECT * FROM board ORDER BY boardtime DESC";
        $query_limit_RecBoard = $query_RecBoard." LIMIT {$startRow_records}, {$limit_records}";

        $queryResult->RecBoard = $this->db_link->query($query_limit_RecBoard);
        $all_RecBoard = $this->db_link->query($query_RecBoard);

        $queryResult->total_records = $all_RecBoard->num_rows;
        $queryResult->total_pages = ceil($queryResult->total_records/$limit_records);
        // echo $query_limit_RecBoard;

        $this->view("List/browse",$queryResult);
    }
    
    function css(){
        echo "Not this place!No!";
    }

    function admin($num_pages=1, $logout=''){
        if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
            header("Location: /mvc/list/login");
        }
        
        if($logout === "logout"){
            unset($_SESSION['loginMember']);
            header("location: /mvc/list/browse");
        }

        $limit_records=5;   
        $queryResult = $this->model("QueryResult");
        $queryResult->num_pages = $num_pages;
        // var_dump($queryResult);

        $startRow_records = ($num_pages -1) * $limit_records;
        $query_RecBoard = "SELECT * FROM board ORDER BY boardtime DESC";
        $query_limit_RecBoard = $query_RecBoard." LIMIT {$startRow_records}, {$limit_records}";

        $queryResult->RecBoard = $this->db_link->query($query_limit_RecBoard);
        $all_RecBoard = $this->db_link->query($query_RecBoard);

        $queryResult->total_records = $all_RecBoard->num_rows;
        $queryResult->total_pages = ceil($queryResult->total_records/$limit_records);
        // echo $query_limit_RecBoard;
        $this->view("list/admin",$queryResult);
    }

    function adminedit($id=""){
        if($id===""){
            header("location:/mvc/list/admin");
        }
        if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
            header("Location: /mvc/list/login");
        }

        $queryResult = $this->model("QueryResult");

        $query_RecBoard = "SELECT boardid, boardname, boardsex, boardsubject, boardmail, boardweb, boardcontent, boardimage FROM board WHERE boardid=?";
        $stmt=$this->db_link->prepare($query_RecBoard);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($queryResult->boardid, $queryResult->boardname, $queryResult->boardsex, $queryResult->boardsubject, $queryResult->boardmail, $queryResult->boardweb, $queryResult->boardcontent, $queryResult->boardimage);
        $stmt->fetch();
        $stmt->close();

        if(isset($_POST["action"])&&($_POST["action"]=="update")){
            echo '1234';
            if($_FILES['authorAvatar']['name'] === ''){
                $_POST['authorAvatar'] = $queryResult->boardimage;
            } else {
                $imageType = substr($_FILES['authorAvatar']['type'],6);
                $imageName = substr($_FILES['authorAvatar']['name'],0,5);
                if($_FILES['authorAvatar']['error'] === 0){
                    if(move_uploaded_file($_FILES['authorAvatar']['tmp_name'],"./images/user-{$_POST['authorName']}$imageName.$imageType"));
                    $_POST['authorAvatar'] = "user-{$_POST['authorName']}$imageName.$imageType";
                }
            }

            $query_update = "UPDATE board SET boardname=?, boardsex=?, boardsubject=?, boardmail=?, boardweb=?, boardcontent=?,boardimage=? WHERE boardid=?";
            $stmt = $this->db_link->prepare($query_update);
            $stmt->bind_param("sssssssi",
                $this->GetSQLValueString($_POST["authorName"], "string"),
                $this->GetSQLValueString($_POST["authorGender"], "string"),
                $this->GetSQLValueString($_POST["messageTitle"], "string"),
                $this->GetSQLValueString($_POST["authorMail"], "email"),
                $this->GetSQLValueString($_POST["authorSite"], "url"),
                $this->GetSQLValueString($_POST["messageContent"], "string"),
                $_POST['authorAvatar'],
                $this->GetSQLValueString($_POST["authorId"], "int"));		
            $stmt->execute();
            $stmt->close();
            header("Location:/mvc/list/adminedit");
            var_dump($_POST);
        }
        $this->view("list/adminedit", $queryResult);
    }

    function admindel($id=""){
        if($id===""){
            header("location:/mvc/list/admin");
        }
        if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
            header("Location: /mvc/list/login");
        }

        if(isset($_POST["action"])&&($_POST["action"]=="delete")){	
            $sql_query = "DELETE FROM board WHERE boardid=?";
            $stmt=$this->db_link->prepare($sql_query);
            $stmt->bind_param("i",$_POST["authorId"]);
            $stmt->execute();
            $stmt->close();
            header("Location: /mvc/list/admin");
        }

        $queryResult = $this->model("QueryResult");

        $query_RecBoard = "SELECT boardid, boardname, boardsex, boardsubject, boardmail, boardweb, boardcontent FROM board WHERE boardid=?";
        $stmt=$this->db_link->prepare($query_RecBoard);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($queryResult->boardid, $queryResult->boardname, $queryResult->boardsex, $queryResult->boardsubject, $queryResult->boardmail, $queryResult->boardweb, $queryResult->boardcontent);
        $stmt->fetch();
        $stmt->close();

        $this->view("list/admindel", $queryResult);
    }

    function login(){
        $tipInfo = "Hi! Welcome back!";
        if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
            if(isset($_POST["userName"]) && isset($_POST["userPwd"])){
                $sql_query = "SELECT * FROM admin where username = '{$_POST["userName"]}'";
                $result = $this->db_link->query($sql_query);

                if($result->num_rows === 0){
                    $tipInfo = 'Sorry, the admin account does not exist.';
                } else {
                    $row_result=$result->fetch_assoc();
                    $userName = $row_result["username"];
                    $userPwd = $row_result["passwd"];
                    if(($userName===$_POST["userName"]) && ($userPwd===$_POST["userPwd"])){
                        $_SESSION["loginMember"]=$userName;
                        header("Location: /mvc/list/admin");
                    } else if($userName===$_POST["userName"]){
                        $tipInfo =  'Password not match, please try again!';
                    }
                }
            }
        }else{
            header("Location: /mvc/list/admin");
        }

        // $_SESSION['loginMember'] = "Admin";
        $this->view("list/login",$tipInfo);
        // header("location: /mvc/list/browse");
    }

    function post(){
        if(isset($_POST["action"])&&($_POST["action"]=="add")){
            var_dump($_POST);
            echo "<br>";echo "<br>";
            var_dump($_FILES);
            if($_FILES['authorAvatar']['name'] === ''){
                $_POST['authorAvatar'] = 'cat.png';
                echo "<br>";echo "<br>";
                var_dump($_POST);
            } else {
                $imageType = substr($_FILES['authorAvatar']['type'],6);
                $imageName = substr($_FILES['authorAvatar']['name'],0,5);
                if($_FILES['authorAvatar']['error'] === 0){
                    if(move_uploaded_file($_FILES['authorAvatar']['tmp_name'],"./images/user-{$_POST['authorName']}$imageName.$imageType"));
                    $tipMessage = 'Upload Success!';
                    echo $tipMessage;
                    $_POST['authorAvatar'] = "user-{$_POST['authorName']}$imageName.$imageType";
                }
            }

            $query_insert = "INSERT INTO board (boardname ,boardsex ,boardsubject ,boardtime ,boardmail ,boardweb ,boardcontent,boardimage) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)";
            $stmt = $this->db_link->prepare($query_insert);
            $stmt->bind_param("sssssss",
                $this->GetSQLValueString($_POST["authorName"], "string"),
                $this->GetSQLValueString($_POST["authorGender"], "string"),
                $this->GetSQLValueString($_POST["messageTitle"], "string"),
                $this->GetSQLValueString($_POST["authorMail"], "email"),
                $this->GetSQLValueString($_POST["authorSite"], "url"),
                $this->GetSQLValueString($_POST["messageContent"], "string"),
                $_POST['authorAvatar']);
            $stmt->execute();
            if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
                header("Location: /mvc/list/admin");
            }else{
                header("Location: /mvc/list/browse");
            }
        }
        $this->view("List/post");
    }

    protected function header(){
        // echo $_SESSION["loginMember"];
        if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
            $loginState = false;
        } else {
            $loginState = true;
        }
        // var_dump($loginState);
        $this->view("List/header",$loginState);
    }

    protected function footer(){
        $this->view("List/footer");
    }

    function __destruct(){
        $this->db_link->close();
    }

    protected function GetSQLValueString($theValue, $theType) {
        switch ($theType) {
        case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
            break;
        case "int":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            break;
        case "email":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
            break;
        case "url":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
            break;      
        }
        return $theValue;
    }
}

?>