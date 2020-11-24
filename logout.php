<?php


    session_start();
    
    //Destroy Session values
    if(isset($_SESSION["id"]) AND isset($_SESSION["name"]) AND isset($_SESSION["email"]) AND isset($_SESSION["password"])){
        session_destroy();      
    }
    //Destroy Cookie values
    if(isset($_COOKIE["id"]) AND isset($_COOKIE["name"]) AND isset($_COOKIE["email"]) AND isset($_COOKIE["pass"])) {
            setcookie("id",$_COOKIE["id"],strtotime("-1 day"),"/","","",TRUE);
            setcookie("name",$_COOKIE["name"],strtotime("-1 day"),"/","","",TRUE);
            setcookie("email",$_COOKIE["email"],strtotime("-1 day"),"/","","",TRUE);
            setcookie("pass",$_COOKIE["pass"],strtotime("-1 day"),"/","","",TRUE);
            unset($_COOKIE["id"]);
            unset($_COOKIE["name"]);
            unset($_COOKIE["email"]);
            unset($_COOKIE["pass"]);
    }
    
    header("location:login.php");


?>