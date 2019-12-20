<?php
require "model_base.php";
require 'bdd.php';

class User extends Model_Base{

	private static $_login;
	private static $_password;
	private static $_pseudo;
	private static $_iddroit;
	const USER_TABLE = 'UTILISATEUR';

	public function __construct($plogin,$pmdp, $ppseudo, $email,$droit,$id)
	{
		$this->_login=$plogin;
		$this->_password=$pmdp;
		$this->_pseudo=$ppseudo;
		$this->_iddroit=$droit;
		$this->_email=$email;
		$this->_id=$id;

		$db=new PDO(SQL_DSN,SQL_USERNAME, SQL_PASSWORD);
		self::set_db($db);
	}	


	public function getInfo()
	{
		$query = self::$_db->prepare('SELECT id, login, mdp, pseudo, email, id_droit FROM UTILISATEUR WHERE login = :login1');
		$query->bindParam(':login1', $this->getLogin());
		$query->execute();

		$users=$query->fetch(PDO::FETCH_ASSOC);
		$this->_id=$users['id'];
		$this->_login=$users['login'];
		$this->_password=$users['mdp'];
		$this->_pseudo=$users['pseudo'];
		$this->_email=$users['email'];
		$this->_iddroit=$users['id_droit'];
	} 

	public function getLogin()
	{
		return $this->_login;
	} 
	public function getmdp()
	{
		return $this->_password;
	} 

	public function getpseudo()
	{
		return $this->_pseudo;
	} 
	public function getdroit()
	{
		return $this->_iddroit;
	} 	

	public function getemail()
	{
		return $this->_email;
	} 
	public function getid()
	{
		return $this->_id;
	} 



	public function setLogin($plogin)
	{
		$this->_login=$plogin;
	}

	public function setmdp($pmdp)
	{
	    $ca=self::$_db->prepare("UPDATE UTILISATEUR SET mdp=:mdp1 WHERE login='".$this->getLogin()."'");
	    $ca->bindvalue(':mdp1',$pmdp);
	    $ca->execute();
	    $this->_password=$pmdp;
	}

	public function setDroit($droit)
	{
		$this->_iddroit=$droit;
	}
	
	public function setemail($email)
	{
		$ca=self::$_db->prepare("UPDATE UTILISATEUR SET email=:email1 WHERE login='".$this->getLogin()."'");
	    $ca->bindvalue(':email1',$email);
	    $ca->execute();
		$this->_email=$email;
	}

	public function create()
	{	
	    $count = self::$_db->prepare("SELECT COUNT(*) AS nbr FROM UTILISATEUR WHERE login='".$this->getLogin()."'");
        $count->execute(array($this->getLogin()));
        $req  = $count->fetch(PDO::FETCH_ASSOC);

        if($req['nbr']==0) //Existe PAS
        {
            
            $a=self::$_db->prepare('INSERT INTO UTILISATEUR(login,mdp,pseudo,email, id_droit) VALUES (:login1,:mdp1, :pseudo1, :email1,:id_droit2)');
            $a->bindParam(':login1',$this->getLogin());
            $a->bindParam(':mdp1', $this->getmdp());
            $a->bindParam(':pseudo1', $this->getpseudo());
            $a->bindParam(':email1', $this->getemail());
            $a->bindParam(':id_droit2', $this->getdroit());

            $a->execute();
           	return;
        }
    }
}

?>