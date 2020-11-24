<?php


    $con = mysqli_connect("localhost","root","","login_registration_ajax");

    if(!$con){
        echo "Error in Connecting ".mysqli_connect_error();
    } else{
        echo "Database Connected<br/>";
    }


    $sql = "CREATE TABLE IF NOT EXISTS user_info(
                id INT(11) NOT NULL AUTO_INCREMENT,
                u_name VARCHAR(255) NOT NULL,
                u_email VARCHAR(255) NOT NULL,
                gender ENUM('m','f') NOT NULL,
                languages VARCHAR(255) NOT NULL,
                country VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                signup_date DATETIME NOT NULL,
                last_login DATETIME NOT NULL,
                act_code VARCHAR(255) NOT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY (u_email)
            )";

    $query = mysqli_query($con, $sql);
    if($query){
        echo "Table Created.<br/>";
    }

    $sql = "ALTER TABLE user_info ADD activated ENUM('0','1') DEFAULT '0' AFTER act_code";
    if(mysqli_query($con, $sql)) {
        echo "Alternation Successfully";
    }

?>