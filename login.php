<?php

    //add login_status page
    include "login_status.php";

    //if login_key value is true means user already login successfully & redirect to profile page
    if($login_key){
        header("location:profile.php");
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Register & Login</title>
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
                margin-top: 10px;
                border: 2px solid #ddd;
                vertical-align: middle;
                cursor: pointer;
            }
            .log_reg>p{
                color: gray;
                font-size: 18px;
                font-family: sans-serif,Arial;
                margin-top: 20px;
                padding: 10px;
                text-align: center;
                
            }
            .log_reg>p>span>a{
                text-decoration: none;
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
            <h2>Login</h2>
            <hr/>
            <div class="msg_err"></div>
            <div class="msg_corr"></div>
            <!-- Form start here-->
            <form onsubmit="return false" method="post" id="login_form">
                
                <label>Email</label>
                <div class="input">
                    <div>
                        <input type="email" name="log_email" id="log_email" placeholder="Email">
                    </div>
                </div>
                
                <label>Password</label>
                <div class="input">
                    <div>
                        <input type="password" name="log_password" id="log_password" placeholder="Password">
                    </div>
                </div>
                
                <div>
                    <a href="forget_password.php" style="float:right; text-decoration:none; margin-right:20px;">Forgot password?</a>
                </div>
                
                <div class="input">
                    <div>
                        <input type="submit" name="login" id="login" value="Login">
                    </div>        
                </div>
                
                <div class="log_reg">
                    <p>Don't have an account? <span style="color:blue; font-weight:bold;"><a href="index.php">Sign up</a></span></p>
                </div>
            </form>
            <!-- Form End Here-->
        </div>
    </body>
</html>