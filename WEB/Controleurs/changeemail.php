<?php
session_start();
require "../Models/user.php";
$user=new User($_SESSION["login"], null, null, null, null, null);
$user->getInfo();

unset($_SESSION['ch_email']);

//SI L'EMAIL RENTREE DANS LE FORMULAIRE CORRESPOND A L'EMAIL DE L'UTILISATEUR
if($user->getemail()==$_POST['email'])
{
	//SI L'ADRESSE ET SA CONFIRMATION SONT IDENTIQUES --> CHANGEMENT
	if($_POST['email1']===$_POST['email2'])
	{	
				$user->setemail($_POST['email2']);
				$_SESSION['ch_email']="Adresse modifiée";
				header("Location: ../Views/profil.php");
	}			
	else
	{
		header("Location: ../Views/profil.php");
		$_SESSION['ch_email']="Erreur adresses différentes";
	}
}
else
{
	header("Location: ../Views/profil.php");
	$_SESSION['ch_email']="Erreur mauvaise adresse";

}
?>

  