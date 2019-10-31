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
	function generer_matricule()
{
   $c=mysqli_connect("loCalhost","lamine","774847102","Gestion_RV") or die(mysqli_error($c));
  $mat="MD-0";
  $date=Date('y');
  $req=("SELECT MAX(id) AS id FROM medecin");
  $exe=mysqli_query($c,$req) or die(mysqli_error($c));
  if($exe==true)
  {
    if(mysqli_num_rows($exe)>0)
    {
      $tab=mysqli_fetch_array($exe);
      $max_id=$tab['id'];
    }
    else
    {
      $max_id=1;
    }

    return $mat."".$date."".($max_id+1);
}
}


?>