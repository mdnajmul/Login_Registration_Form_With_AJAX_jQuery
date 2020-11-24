<?php

    
    //add login_status page
    include "login_status.php";

    //Here, login key value is false means user do not logged in his account & than redirect to login page for login
    if(!$login_key){
        header("location:login.php");
    }


    //Here, session id value is false means user do not logged in his account & than redirect to index page
    if(!isset($_SESSION["id"])){
        
        header("location:index.php");
    }


?>



<!DOCTYPE html>
<html>
	<head>
	    <title>Profile</title>
		<style>
		 body{font-family:<?php echo $fonts; ?>;}
		.phpcoding{width:900px; margin: 0 auto; background:#ddd;}
		.headeroption, .footeroption{background:<?php echo $bgcolor; ?>; color:<?php echo $fontcolor; ?>; text-align:center; padding:20px;}
		.headeroption h2, .footeroption h2{margin:0; font-size:24px;}
		.maincontent{min-height:400px; padding:20px; font-size:18px;}
		 p{margin:0}
		input[type="text"],input[type="password"]{width:238px; padding:5px;}
		select{font-size:18px; padding:2px 5px; width:250px;}
		.tblone{width:100%; border:1px solid #fff; margin:20px 0;text-align: left;}
		.tblone td{padding:5px 10px; text-align:center;}
		table.tblone tr:nth-child(2n+1){background:#fff; height:30px;}
		table.tblone tr:nth-child(2n){background:#f1f1f1; height:30px;}
		#myform{width:100%; border:1px solid #fff; padding:10px;}
        .myuniversity{width: 815px; min-height: 300px; background: #fff; border: 1px solid #999; padding: 15px; margin-top: 10px;}
        .error_form{color: red; font-size: 15px;}
        .myuniversity>p>a{
              text-decoration: none;
              background: red;
              color: #fff;
              font-weight: bold;
              width: 300px;
              height: 30px;
              border: 2px solid #ddd;
              border-radius: 40px;
              margin-top: 20px;
              padding: 10px;
            }
            .myuniversity>p{
                text-align: center;
            }
            .myuniversity>h3{
                text-align: center;
                color: green;
                margin-top: 40px;
                font-size: 18px;
                font-weight: bold;    
            }    
        
         
		</style>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="main.js"></script>
	</head>
	<body>
        <div class="phpcoding">
			<section class="headeroption">
			        <h2><?php echo "DASHBOARD: Welcome! Your Profile"; ?></h2>
			</section>
			
			<section class="maincontent">
			
                <div class="myuniversity">
                    
                    <h3><?php echo "Hi Mr.".$_SESSION["name"]."<br/><br/>";?></h3>
                    <h3>
                        <?php
                            echo "<span style='color:red;'>Your Session Values:</span><br/>";
                            echo "<span style='color:blue;'>session_name: </span>".$_SESSION["name"]."<br/>";
                            echo "<span style='color:blue;'>session_id: </span>".$_SESSION["id"]."<br/>";
                            echo "<span style='color:blue;'>session_email: </span>".$_SESSION["email"]."<br/>";
                            echo "<span style='color:blue;'>session_password:</span>".$_SESSION["password"]."<br/><br/>";
                            echo "<span style='color:red;'>Your Cookies Values:</span><br/>";
                            echo "<span style='color:blue;'>cookie_name: </span>".$_COOKIE["name"]."<br/>";
                            echo "<span style='color:blue;'>cookie_id: </span>".$_COOKIE["id"]."<br/>";
                            echo "<span style='color:blue;'>cookie_email: </span>".$_COOKIE["email"]."<br/>";
                            echo "<span style='color:blue;'>cookie_password: </span>".$_COOKIE["pass"]."<br/>";
                        ?>
                    </h3>
                    <p><a href="logout.php">Logout</a></p>
                    
                </div>
                
            </section>
            
            <section class="footeroption">
			       <h2><?php echo "AJAX,JQUERY,PHP LOGIN & REGISTRATION"; ?></h2>
			</section>
		</div>
	</body>
</html>
