<?php

session_start();

/*
Process will contain methods like
1 - Check validation & existence of email in our database
2 - Insertion of Record
3 - Send Activation link to user email Address
4 - Selection of Record
*/


//Add database page
include "db.php";
$db = new Database;


class Process extends Database{

    //**Validation & Verify email address**//
    public function verify_email($table,$email){
        //regular expression for email
        $regexp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";

        if(!preg_match($regexp,$email)){
			return "invalid_email";
		}
        //check email already exists or not
        $sql = "SELECT id FROM ".$table." WHERE u_email = '$email' LIMIT 1";
		$query = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($query);
        if($count == 1){
			return "already_exists";
		}else{
			return "ok";
		}
    }
    
    //**Insert data into database table**//
    public function insert_record($table, $input){
        $sql = "";
        $sql .= "INSERT INTO ".$table." ";
        $sql .= "(".implode(",", array_keys($input)).") VALUES ";
        $sql .= "('".implode("','", array_values($input))."')";
        $query = mysqli_query($this->con,$sql);
        $last_id = mysqli_insert_id($this->con);
        if($query){
            return $last_id;
        }
    }
    
    
    //**send activation code/link to user email address through this function**//
    public function send_activation_code($email, $act_code, $uid){
        $to = $email; //user email where we send activation code
        $subject = 'Activation link from Najmul Ovi'; //email subject
        $from = 'neberhossain8@gmail.com'; //admin email & activation code send from this email
        
        //To send HTML mail, the Content-type header must be set
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        //Create email headers
        $headers .= "From: ".$from."\r\n Reply-To: ".$from."\r\n X-Mailer: PHP/".phpversion();     
        
        //Compose a simple HTML email message
        $message = "<html><body>";
        $message .= "<h1 style='color:#f40000;'>Hi $email</h1>";
        $message .= "<p style='color:#333; font-size:14px; font-family:san-serif,Arial;'>please click on given link to activate your account</p>";
        $message .= "<a href='http://localhost/new_project/Login_Registration_Form_With_AJAX_jQuery/activation_code.php?ACTIVATION_CODE=".$act_code."&uid=".$uid."&ue=".$email."'>Click here</a>";
        $message .= "</body></html>";
        
        //Sending mail
        if(mail($to, $subject, $message, $headers)){
            return true;
        } else{
            return false;
        }
    }
    
    
    //**serch/fetch data from database table for user login information**//
    public function select_record($table,$where_condition){
        $sql = "";
        $condition = "";
        $array = array();
        //set conditon that which user data will be fetch from database
        foreach($where_condition as $key => $value){
            $condition .= $key . "='".$value."' AND ";
        }
        //remove 'And' from end
        $condition = substr($condition, 0,-5);
        //write select query
        $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        //execute the query
        $query = mysqli_query($this->con,$sql);
        //fetch all data and put inside $row array
        while($row = mysqli_fetch_array($query)){
            //put all $row array values inside $array array value
            $array = $row;
        }
        return $array;
    }
    
    
    //select query method for reset password
    public function select_data($res_email){
        $email = mysqli_real_escape_string($this->con,$res_email);
        $sql = "SELECT id,note FROM user_info WHERE u_email = '$email' AND activated = '1' LIMIT 1";
        $query = mysqli_query($this->con,$sql);
        $count = mysqli_num_rows($query);
        
        if($count == 1){
            return mysqli_fetch_array($query);
            
        } else{
            return "not_exists";
        }
    }
    
    
    
    //update query method for reset password
    public function update_data($random_note,$uid,$email){
        $update_note = "UPDATE user_info SET note = '$random_note' WHERE id = '$uid' AND u_email = '$email'";
        return mysqli_query($this->con,$update_note);
        
    }
    
    


}

//Create object of Process class
$pr = new Process;



//hold name from js file for validation
if(isset($_POST["check_name"])){
    //hold email from js file
    $name = $_POST["name"];
    
    $regexp = "/^[A-Za-z ]/";

    if(!preg_match($regexp,$name)){
        echo "invalid_name";
        exit();
    } else{
        echo "ok";
        exit();
    }
    
}


//hold email from js file for validation
if(isset($_POST["check_email"])){
    //hold email from js file
    $email = $_POST["email"];
    
    echo $data = $pr->verify_email("user_info",$email);
    exit();
    
}


//hold password from js file for validation
if(isset($_POST["check_pass"])){
    //hold email from js file
    $password = $_POST["password"];

    if(strlen($password) < 5){
        echo "password_short";
        exit();
    } else{
        echo "ok";
        exit();
    }
    
}



//hold confirm password from js file for validation
if(isset($_POST["check_repass"])){
    //hold email from js file
    $repassword = $_POST["repassword"];
    $password = $_POST["password"];

    if(strlen($repassword) < 5){
        echo "password_short";
        exit();
    } else if($repassword != $password){
        echo "not_matched";
        exit();
    }
    else{
        echo "ok";
        exit();
    }
    
}






//hold form data from Registration Form
if(isset($_POST["u_email"])){
    $check = false;
    
    //validate gender or lang feilds are empty or not
    if(empty($_POST["gender"]) || empty($_POST["lang"])){
        $check = true;
        echo "empty_feilds";
        exit();
    }
    
    //hold user name with validation
    $name = preg_replace("#[^A-Za-z ]#i", "", $_POST["u_name"]);
    
    //hold user email with validation
    $data = $pr->verify_email("user_info",$_POST["u_email"]);
    if($data == "already_exists"){
        $check = true;
        echo "Email Already Exists";
        exit();
    } else if($data == "invalid_email"){
        $check = true;
    }
    else{
        $email = $_POST["u_email"];
    }
    
    //hold gender value with validation
    $gender = preg_replace("#[^a-z]#i", "", $_POST["gender"]);
    
    //hold user country name with validation
    $country = preg_replace("#[^A-Za-z ]#i", "", $_POST["u_country"]);
    
    
    //**hold language with validation**//
        //hold all languages
        $lang = $_POST["lang"];
        //count number of language
        $count = count($lang);
        //create flag variable called $languages
        $languages = "";
        //write for loop for hold all languages from lang[] array
        for($i=0; $i<$count; $i++){
            $languages .= $lang[$i].",";
        }
        //remove last ',' from $languages value
        $languages = substr($languages, 0, -1);
        //validate email
        $languages = preg_replace("#[^A-Za-z,]#i", "", $languages);
    
    
    //hold password
    $password = $_POST["password"];
    
    //hold confirm password
    $repassword = $_POST["repassword"];
    
    $check = "";
    
    
    
    //**Start Validation from here**//
    
        //check email,password,country,language fields are empty or not
        if(empty($name) || empty($email) ||  empty($country) || empty($password) || empty($repassword)){
            $check = true;
            echo "empty_feilds";
            exit();
        }
    
        //check password length is less than 5 or not
        if(strlen($password) < 5){
            $check = true;
            echo "password_short";
            exit();
        }
    
        //check password & confirm_password feild is match/same or not
        if($password != $repassword){
            $check = true;
            echo "not_same";
            exit();
        } else{
            //create hash password//
            /**
             * In this case, we want to increase the default cost for BCRYPT to 12.
             * Note that we also switched to BCRYPT, which will always be 60 characters.
             **/
            $options = ["COST" => 12];
            $hash_password = password_hash($password,PASSWORD_DEFAULT,$options);
        }
    
    //create/hold signup date
    $signup_date = date("Y-m-d H:i:s");
    
    //create activation code
    $act_code = time().md5($email).rand(50000,1000000);
    $act_code = str_shuffle($act_code);
    $note = "";
    
    if($check == false){
    //create an array which values are passes to the insert_record() method. That values are use for insert data into database
    $user = array("u_name"=>$name,"u_email"=>$email,"gender"=>$gender,"languages"=>$languages,"country"=>$country,"password"=>$hash_password,"signup_date"=>$signup_date,"last_login"=>$signup_date,"act_code"=>$act_code,"note"=>$note,"activated"=>"0");
    //hold last id
    $id = $pr->insert_record("user_info",$user);
    
    if($id){
        //divide user email into two part.One is before '@' and other is after '@'.Example: najmul@gmail.com divided into [0]=>"najmul",[1]=>"gmail.com"
        $username = explode("@", $email);
        $userdir = $username[0];
        //if that file is not exists in user directory than create that file
        if(!file_exists("user/$userdir".$id)){
            //create directory
            mkdir("user/$userdir".$id,0755);
        }
        //send email & id to send_activation_code() nethod
        if($pr->send_activation_code($email,$act_code,$id)){
            echo "email_send_success";
            exit();
        } else{
            echo "email not send";
            exit();
        }
    }
        
  }
    
    
}







//User Login Process
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    
    if(empty($_POST["log_email"]) || empty($_POST["log_password"])){
        echo "empty_feilds";
        exit();
    }
    
    //verify email address
    $data = $pr->verify_email("user_info",$_POST["log_email"]);
    
    if($data == "ok"){
        echo "not_exists";
        exit();
    } else if($data == "invalid_email"){
        echo "invalid_email";
        exit();
    } else if($data == "already_exists"){
        //put log email inside a array which key is 'u_email'
        $email = array("u_email"=>$_POST["log_email"]);
        $row = $pr->select_record("user_info",$email);
        //put activated value from database
        $activated = $row["activated"];
        
        if($activated == '1'){
                //If user account is activated than math given password with database password value through password_verify() build in function
                if(password_verify($_POST["log_password"],$row["password"])){
                    //**Session Variables**//
                    //if login success than set SESSION
                    $_SESSION["name"] = $row["u_name"];
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["email"] = $row["u_email"];
                    $_SESSION["password"] = $row["password"];
                    
                    //**Cookies Variables**//
                    //if login success than set Cookies
                    setcookie("id",$row["id"],strtotime("+1 day"),"/","","",TRUE);
                    setcookie("name",$row["u_name"],strtotime("+1 day"),"/","","",TRUE);
                    setcookie("email",$row["u_email"],strtotime("+1 day"),"/","","",TRUE);
                    setcookie("pass",$row["password"],strtotime("+1 day"),"/","","",TRUE);
                    
                    echo "login_success";
                    exit();
                } else{
                    echo "error_password";
                    exit();
                }
            } else if($activated == '0'){
                    echo "verify_email";
                    exit();
            }
    }
}








//Reset Password
if(isset($_POST["recovery_email"])){
    
            if(empty($_POST["recovery_email"])){
                echo "empty_feilds";
                exit();
            }
    
            $row = $pr->select_data($_POST["recovery_email"]);
            if($row != "not_exists"){
                $uid = $row["id"];
                $note = $row["note"];
            
                //To make user the given email address is correct or not we will send email his/her to confirm
                if($note != ""){
                    echo "message_send";
                    exit();
                } else{
                    //Here we will generate some random number
                    $random_note = time().rand(5000,100000);
                    $random_note = str_shuffle($random_note);
                    
                    $query = $pr->update_data($random_note,$uid,$_POST["recovery_email"]);
                    if($query){
                        $to = $_POST["recovery_email"];
                        $sub = "Reset Password";
                        $from = 'neberhossain8@gmail.com'; //admin email & activation code send from this email

                        //To send HTML mail, the Content-type header must be set
                        $header = "MIME-Version: 1.0\r\n";
                        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        $header .= "From: ".$from."\r\n Reply-To: ".$from."\r\n X-Mailer: PHP/".phpversion(); 

                        $msg = "<html><body>";
                        $msg .= "<p style='color:#333; font-size:14px; font-family:san-serif,Arial;'>Please click on the given link to reset your password</p>";
                        $msg .= "<a href='http://localhost/new_project/Login_Registration_Form_With_AJAX_jQuery/password_reset.php?note=".$random_note."&uid=".$uid."&email=".$_POST["recovery_email"]."'>Reset Password</a>";
                        $msg .= "</body></html>";


                        if(mail($to,$sub,$msg,$header)){
                            echo "confirm_message";
                            exit();
                        }
                    }
                }
        } else{
            echo "not_exists";
            exit();
        }
    }








//Update New Password
if(isset($_POST["uid"]) AND isset($_POST["email"]) AND isset($_POST["new_pass"]) AND isset($_POST["confirm_pass"])){
    $n_pass = $_POST["new_pass"];
    $c_pass = $_POST["confirm_pass"];
    $uid = $_POST["uid"];
    $email = $_POST["email"];
    
    if(empty($n_pass) || empty($c_pass)){
        echo "empty_feilds";
        exit();
    }
    
    if(strlen($n_pass) < 5 || strlen($c_pass) < 5){
        echo "password_length";
        exit();
    } else{
        if($n_pass == $c_pass){
            $options = [ "COST" => 12];
            $hash_new_password = password_hash($n_pass,PASSWORD_DEFAULT,$options);
             
            $sql = "UPDATE user_info SET password = '$hash_new_password' WHERE id = '$uid' AND u_email = '$email'";
            $query = mysqli_query($db->con,$sql) or die(mysqli_error($db->con));

            if($query){
                echo "success";
                exit();
            }
        } else{
            echo "not_match";
            exit();
        }
    }
}




?>
