$(document).ready(function(){
    
    //check name is valid or not 
    function verify_name(name){
        $(".u_error").hide();
        $(".u_correct").hide();
        if(name == ""){
            $(".u_error").show();
            $(".u_error").html("Please enter your name");
            
        } else{
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {check_name:1,name:name},
                success: function(data){               
                   if(data == "invalid_name"){
                       $(".u_error").show();
                        $(".u_error").html("Invalid Name");
                    } else if(data == "ok"){
                        $(".u_correct").show();
                        $(".u_correct").html("OK");
                    }
                }
            });
        }  
    }
    
    $("#u_name").focusout(function(){
        var name = $("#u_name").val();
        verify_name(name);
    });
    
    
    
    //check valid email
    function verify_email(email){
        $(".e_error").hide();
        $(".e_correct").hide();
        if(email == ""){
            $(".e_error").show();
            $(".e_error").html("Please enter your email address");
            
        } else{
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {check_email:1,email:email},
                success: function(data){

                    
                    if(data == "already_exists"){
                        $(".e_error").show();
                        $(".e_error").html("Email Already Exists");
                    } else if(data == "invalid_email"){
                        $(".e_error").show();
                        $(".e_error").html("Invalid Email Address");

                    } else if(data == "ok"){
                        $(".e_correct").show();
                        $(".e_correct").html("OK");
                    }
                }
            });
        }
    }
    
    $("#u_email").focusout(function(){
        var email = $("#u_email").val();
        verify_email(email);
    });
    
    
    
    
    //check valid password
    function verify_pass(password){
        $(".p_error").hide();
        $(".p_correct").hide();
        if(password == ""){
            $(".p_error").show();
            $(".p_error").html("Please enter password");
            
        } else{
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {check_pass:1,password:password},
                success: function(data){               
                   if(data == "password_short"){
                       $(".p_error").show();
                        $(".p_error").html("Password too short!");
                    } else if(data == "ok"){
                        $(".p_correct").show();
                        $(".p_correct").html("OK");
                    }
                }
            });
        }  
    }
    
    $("#password").focusout(function(){
        var password = $("#password").val();
        verify_pass(password);
    });
    
    
    
    
    //check valid password & match with previous password
    function verify_repass(repassword){
        var password = $("#password").val();
        $(".re_error").hide();
        $(".re_correct").hide();
        if(repassword == ""){
            $(".re_error").show();
            $(".re_error").html("Please enter password");
            
        } else{
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {check_repass:1,repassword:repassword,password:password},
                success: function(data){               
                   if(data == "password_short"){
                       $(".re_error").show();
                       $(".re_error").html("Password too short!");
                    } else if(data == "not_matched"){
                       $(".re_error").show();
                       $(".re_error").html("Password not matched!");
                    } else if(data == "ok"){
                        $(".re_correct").show();
                        $(".re_correct").html("OK");
                    }
                }
            });
        }  
    }
    
    $("#repassword").focusout(function(){
        var repassword = $("#repassword").val();    
        verify_repass(repassword);
    });
    
    
    //Register user
    $("#register_form").on("submit",function(){
        $(".msg_err").hide();
        $(".msg_corr").hide();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: $("#register_form").serialize(),
            success: function(data){
                 
                if(data == "empty_feilds"){
                    $(".msg_err").show();
                    $(".msg_err").html("Please fill all feilds with valid values");
                }  
                if(data == "email_send_success"){
                    alert("Success! Wait for next page...");
                    $(".msg_corr").show();
                    $(".msg_corr").html("You are successfully registered");
                    window.location.href="verify_email.php";
                }
            },
            complete: function(){
                $("#register_form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
        });
    });
    
    
    //Login user
    $("#login_form").on("submit",function(){
        $(".msg_err").hide();
        $(".msg_corr").hide();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: $("#login_form").serialize(),
            success: function(data){
                if(data == "empty_feilds"){
                    $(".msg_err").show();
                    $(".msg_err").html("Please enter email or password !");
                }
                if(data == "not_exists" || data == "error_password"){
                    $(".msg_err").show();
                    $(".msg_err").html("Email or Password does not matched! !");
                    
                }
                if(data == "verify_email"){
                    $(".msg_err").show();
                    $(".msg_err").html("Please verify your email address !");
                }
                if(data == "login_success"){
                    $(".msg_corr").show();
                    $(".msg_corr").html("You are successfully Login!");
                    window.location.href = "profile.php";
                }
            },
            complete: function(){
                $("#login_form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
        });
        
    });
    
    
    
    //Reset Password
    $("#forget_pass_form").on("submit",function(){
        $(".msg_err").hide();
        $(".msg_corr").hide();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: $("#forget_pass_form").serialize(),
            success: function(data){
                if(data == "empty_feilds"){
                    $(".msg_err").show();
                    $(".msg_err").html("Please enter your email address !");
                }
                if(data == "message_send"){
                    $(".msg_corr").show();
                    $(".msg_corr").html("Please check your email address, we have already sended you a password reset link.");
                }
                if(data == "confirm_message"){
                    $(".msg_corr").show();
                    $(".msg_corr").html("Please confirm your email to reset your password.");
                }
                if(data == "not_exists"){
                    $(".msg_err").show();
                    $(".msg_err").html("Your email address not exists in our records!");
                }

            },
            complete: function(){
                $("#forget_pass_form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
        });

    });
    
    
    
    //Update New Password
    $("#recovery_pass_form").on("submit",function(){
        $(".msg_err").hide();
        $(".msg_corr").hide();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: $("#recovery_pass_form").serialize(),
            success: function(data){
                if(data == "empty_feilds"){
                    $(".msg_err").show();
                    $(".msg_err").html("Please fill up password feilds !");
                }
                if(data == "password_length"){
                    $(".msg_err").show();
                    $(".msg_err").html("Password length should be 5 or more!");
                }
                if(data == "success"){
                    $(".msg_corr").show();
                    $(".msg_corr").html("Password reset successfully. Now you can login!");
                }
                if(data == "not_match"){
                    $(".msg_err").show();
                    $(".msg_err").html("Password does not matched!");
                }

            },
            complete: function(){
                $("#recovery_pass_form").each(function(){
                    this.reset();   //Here form fields will be cleared.
                });
            }
            
        });
          
    });
    
    
    
});