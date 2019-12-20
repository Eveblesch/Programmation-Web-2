<?php
session_start();
require "../Models/user.php";

$user=new User($_SESSION["login"], null, null, null, null, null);
$user->getInfo();

	$a=$bdd->prepare('DELETE FROM COMMENTAIRE WHERE id=:id2');
	$a->bindParam(':id2', $_GET['nom']);
	$a->execute();
	header("Location: ../droit.php");	



?>
