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
                color: green;
                font-size: 14px;
                font-family: sans-serif,Arial;
                margin: 12px;
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
            <h2>Register</h2>
            <hr/>
            <div class="msg_err"></div>
            <div class="msg_corr"></div>
            <!-- Form start here-->
            <form onsubmit="return false" method="post" id="register_form">
                <label>Name</label>
                <div class="input">
                    <div>
                        <input type="text" name="u_name" id="u_name" placeholder="Name">
                    </div>
                    <div class="error u_error"></div>
                    <div class="correct u_correct"></div>
                </div>
                <label>Email</label>
                <div class="input">
                    <div>
                        <input type="email" name="u_email" id="u_email" placeholder="Email">
                    </div>
                    <div class="error e_error"></div>
                    <div class="correct e_correct"></div>
                </div>
                <label>Gender</label>
                <div class="input">
                    <div style="margin-top: 10px;">
                        <input type="radio" name="gender" id="gender" value="m">Male
                        <input type="radio" name="gender" id="gender" value="f">Female
                    </div>
                    <div class="error"></div>
                </div>
                <label>Choose Country</label>
                <div class="input">
                    <div>
                        <select class="input-opt" name="u_country">
                            <option value="">Choose Country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="China">China</option>
                            <option value="England">England</option>
                            <option value="India">India</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Newzeland">Newzeland</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Srilanka">Srilanka</option>
                            <option value="South Africa">South Africa</option>
                            <option value="USA">USA</option>
                        </select>
                    </div>
                    <div class="error"></div>
                </div>
                <label>Languages Known</label>
                <div class="input">
                    <div style="margin-top: 10px;">
                        <input type="checkbox" name="lang[]" value="English">English
                        <input type="checkbox" name="lang[]" value="Bangla">Bangla
                        <input type="checkbox" name="lang[]" value="Hindi">Hindi
                    </div>
                    <div class="error"></div>
                </div>
                <label>Choose Password</label>
                <div class="input">
                    <div>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="error p_error"></div>
                    <div class="correct p_correct"></div>
                </div>
                <label>Confirm Password</label>
                <div class="input">
                    <div>
                        <input type="password" name="repassword" id="repassword" placeholder="Password">
                    </div>
                    <div class="error re_error"></div>
                    <div class="correct re_correct"></div>
                </div>
                <div class="input">
                    <div>
                        <input type="submit" name="register" value="Register">
                    </div>
                </div>
                
                <div class="log_reg">
                    <p>Already have an account? <span style="color:blue; font-weight:bold; text-decoration: none;"><a href="login.php">Sign in</a></span></p>
                </div>
            </form>
            <!-- Form End Here-->
        </div>
    </body>
</html>