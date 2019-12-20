<?php
session_start();
require "../Models/user.php";

unset($_SESSION['message_droit']);
$user=new User($_SESSION["login"], null, null, null, null, null);
$user->getInfo();

//ON RECUPERE LE DROIT QUI VA REMPLACER L'ANCIEN DROIT
	if($_POST['droit']=="Administrateur")
		$recup_droit=3;
	else if ($_POST['droit']=="Moderateur")
		$recup_droit=2;
	else if($_POST['droit']=="Utilisateur")
		$recup_droit=1;
	else
		$recup_droit=-1;

//SI LE CHOIX RENTRE EST CORRECTE
	if($recup_droit!=(-1))
	{
		$_SESSION['changement_utilisateur']; // =$user->getid()
		$a=$bdd->prepare("UPDATE UTILISATEUR SET id_droit=:droit2 WHERE id='".$_SESSION['changement_utilisateur']."'");
		$a->bindParam(':droit2',$recup_droit);
		$a->execute();

		$user->setDroit($recup_droit);
		//unset($_SESSION['changement_utilisateur']); 
		
		$_SESSION['message_droit']="Droit modifié";
		header("Location: ../Views/profil_utilisateur.php");

	}
	else
	{
		$_SESSION['message_droit']="Erreur mauvais utilisateur";
		header("Location: ../Views/profil_utilisateur.php");
	}