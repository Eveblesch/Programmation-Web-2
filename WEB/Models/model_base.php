<?php
require "bdd.php";
class Model_Base
{
	protected static $_db;
	public static function set_db(PDO $db) 
	{
		
		try
		{
			self::$_db = $db;
		}
		catch (PDOException $e)
		{
			$_SESSION['message'] = $e->getMessage();
			header('Location: ../../Views/connexion/signin.php');
			exit;
		}
	}
	


}
?>