<?php

    include "db.php";
    $db = new Database;

    if(isset($_REQUEST["note"]) AND isset($_REQUEST["uid"]) AND isset($_REQUEST["email"])){
        $note = preg_replace("#[^0-9]#", "", $_REQUEST["note"]);
        $uid = preg_replace("#[^0-9]#", "", $_REQUEST["uid"]);
        $email = mysqli_real_escape_string($db->con,$_REQUEST["email"]);
    
        
        $sql = "SELECT id FROM user_info WHERE note = '$note' AND u_email = '$email' AND id = '$uid' LIMIT 1";
        $query = mysqli_query($db->con,$sql);
        
        if($query) {

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Recovery Password</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="main.js"></script>
        
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                background: #333;
            }
            .form {
                width: 500px;
                padding: 20px;
                background: #eee;
                border-radius: 5px;
                box-shadow: 1px 1px 1px gray;
                margin: 25px auto;
                color: #333;
                font-family: sans-serif,Arial;
            }
            .form h2 {text-align: center;}
            label {
                font-weight: bold;
            }
            .input {
                width: 100%;
                height: 50px;
            }
            .input>div {
                float: left;
                min-width: 200px;
            }
            input[type="text"],
            input[type="password"],
            input[type="email"],
            .input-opt {
                width: 250px;
                height: 30px;
                border-radius: 5px;
                color: gray;
                font-size: 16px;
                font-family: sans-serif,Arial;
                outline: none;
                margin-top: 5px;
                border: 2px solid #ddd;
            }
            .error {
                color: red;
                font-family: sans-serif,Arial;
                font-size: 14px;
                margin: 12px;
            }
            .correct {
                color: darkgreen;
                font-size: 16px;
                font-family: sans-serif,Arial;
            }
            input[type="submit"]{
                width: 500px;
                height: 40px;
                background: #399CFF;
                border-radius: 40px;
                color: #fff;
                font-weight: bold;
                font-size: 16px;
                font-family: sans-serif,Arial;
                outline: none;
                border: 2px solid #ddd;
                vertical-align: middle;
                cursor: pointer;
                margin-bottom: 20px;
            }
            .msg_err{
                color: red;
                font-family: sans-serif,Arial;
                font-size: 18px;
                margin: 12px;
                text-align: center;
                font-weight: bold;
                
            }
            .msg_corr{
                color: green;
                font-family: sans-serif,Arial;
                font-size: 18px;
                margin: 12px;
                text-align: center;
                font-weight: bold;
                
            }
            
        </style>
    </head>

    <body>
        <div class="form">
            <h2>Password Recovery</h2>
            <hr/>
            <div class="msg_err"></div>
            <div class="msg_corr"></div>
            <!-- Form start here-->
            <form onsubmit="return false" method="post" id="recovery_pass_form">
               
                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                <input type="hidden" name="email" value="<?php echo $email;?>">
                <label>New Password</label>
                <div class="input">
                    <div>
                        <input type="password" name="new_pass" id="new_pass" placeholder="Enter Password">
                    </div>
                    <div class="error e_error"></div>
                </div>
                <label>Confirm Password</label>
                <div class="input">
                    <div>
                        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Enter Password">
                    </div>
                    <div class="error e_error"></div>
                </div>

                <div class="input">
                    <div>
                        <input type="submit" name="change_password" id="change_password" value="Reset Password">
                    </div>
                           
                </div>              
            </form>
            <!-- Form End Here-->
        </div>
    </body>
</html>


<?php 
            
    } else{
            echo "Error: Please try again...!";
        }
}

?>