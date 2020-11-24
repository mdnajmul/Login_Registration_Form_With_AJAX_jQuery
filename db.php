<?php


/**
* Database Class
*/
//Database Constants
define("HOST","localhost");//Dont forget to change your server or Host name
define("USER","root");//Dont forget to chnage your database username
define("PASSWORD","");//Dont forget to change your password
define("DB","login_registration_ajax");//your database name


class Database
{
	public $con;
	function __construct()
	{
		$this->con = mysqli_connect(HOST,USER,PASSWORD,DB);
		if(!$this->con){
			echo "Connecting Error ".mysqli_connect_error();
		}
	}
}


//Create Object of Database Class




?>