<?php 
	session_start();
	require_once '../Models/bdd.php';

//SUPPRESSION DE l'UTILISATEUR	
if(($_SERVER['REQUEST_METHOD'] == 'GET') && ($_SESSION['logged']==true))
{
	$a=$bdd->prepare('DELETE FROM UTILISATEUR WHERE login="'.$_SESSION['login'].'"');
	$a->execute();
	session_destroy();
	header("Location: ../droit.php");
}
else
{
	header("Location: ../Views/profil.php");
}

?>

