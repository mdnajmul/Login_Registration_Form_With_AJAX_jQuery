<?php

    //include database page for connection
    include "db.php";

    //create a global flag variable
    //This variable will tell you about your login status
    $login_key = false;

    class LoginStatus extends Database{
        
        public function userLogin($id,$email,$password){
            $email = mysqli_real_escape_string($this->con,$email);
            //check user Credentials
            $sql = "SELECT id FROM user_info WHERE id = '$id' AND u_email = '$email' AND password = '$password' LIMIT 1";
            $query = mysqli_query($this->con,$sql);
            $count = mysqli_num_rows($query);
            
            if($count == 1){
                //This login date will tell us about last visit or last login of user
                $login_date = date("Y-m-d H:i:s");
                $update_login_date = "UPDATE user_info SET last_login = '$login_date' WHERE id = '$id' AND u_email = '$email'";
                $query = mysqli_query($this->con,$update_login_date) or die(mysqli_error($this->con));
                return true;
            }
            return false;
        }
    }

    //create object of LoginStatus class
    $lg = new LoginStatus;

    //hold session values & pass these values to the userLogin() function
    if(isset($_SESSION["id"]) AND isset($_SESSION["name"]) AND isset($_SESSION["email"]) AND isset($_SESSION["password"])) {
        $id = preg_replace("#[^0-9]#", "", $_SESSION["id"]);
        $email = $_SESSION["email"];
        $password = $_SESSION["password"];
        
        $login_key = $lg->userLogin($id,$email,$password);
        
    } else{
        //hold cookie values & pass these values to the userLogin() function
        if (isset($_COOKIE["id"]) AND isset($_COOKIE["name"]) AND isset($_COOKIE["email"]) AND isset($_COOKIE["pass"])) {
		
            $_SESSION["name"] = $_COOKIE["name"];
            $_SESSION["id"] = preg_replace("#[^0-9]#", "", $_COOKIE["id"]);
            $_SESSION["email"] = $_COOKIE["email"];
            $_SESSION["password"] = $_COOKIE["pass"];

            $login_key = $lg->userLogin($_SESSION["id"],$_SESSION["email"],$_SESSION["password"]);

        }
        
    }




?>