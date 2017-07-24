<?php

	/* Include PDO */
	
	if( $_SERVER['HTTP_HOST'] == '127.0.0.1:8080' || $_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'],'gm-'))
	{
		/* Caso seja Local */
		$engine = 'mysql'; 
		$host = "localhost";
		$user = "root";
		$pass = "";
		$database = "hakai276_thutor";
		//echo "Conectado Local";
	}
	else
	{
		/* Caso seja online */
		$engine = 'mysql'; 
		$host = "localhost";
		$user = "";
		$pass = "";
		$database = "";
		//echo "Conectado Remoto";
		
	}
	
	$dns = $engine.':dbname='.$database.";host=".$host; 
	
	try
	{
		$pdo = new PDO ($dns , $user , $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}
	catch ( PDOexception $e )
	{
		echo $e->getMessage();
	}
	
	
?>
