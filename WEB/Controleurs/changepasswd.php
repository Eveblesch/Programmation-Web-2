<?php
session_start();
require "../Models/user.php";
$user=new User($_SESSION["login"], null, null, null, null, null);
$user->getInfo();

unset($_SESSION['ch_mdp']);

//SI LE MOT DE PASSE ENTREE CORRESPOND A CELUI DANS LA BDD
if(password_verify($_POST['mdp'],$user->getmdp()))
{
	//SI LE NOUVEAU MDP ET SA CONFIRMATION SONT IDENTIQUES
	if($_POST['mdp1']===$_POST['mdp2'])
	{	
				$user->setmdp(password_hash($_POST['mdp2'],PASSWORD_DEFAULT));
				header("Location: ../Views/profil.php");
				$_SESSION['ch_mdp']="Mot de passe modifié";
	}			
	else
	{
		header("Location: ../Views/profil.php");
		$_SESSION['ch_mdp']="Erreur mots de passe différents";
	}
}
else
{
	header("Location: ../Views/profil.php");
	$_SESSION['ch_mdp']="Erreur mauvais mot de passe";
}
?>

  