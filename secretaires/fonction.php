<?php

class database
{
	private static $dbhost="localhost";
	private static $dbname="Gestion_RV";
	private static $user="lamine";
	private static $password="774847102";

	private static $connexion=null;
	
	public  static function connect()
	{

		try {
			self::$connexion = new PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbname,self::$user,self::$password);
			
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return self::$connexion;
	}

	function deconnect()
	{
		self::$connexion= null;

	}


		
}


?>