<?php
	session_start();
	require_once "../Models/user.php";
	$user=new User($_SESSION["login"], null, null, null, null, null);
	$user->getInfo();


	$topic=$_SESSION["test"];
	$commentaire=htmlentities($_POST['commentaire']);

	//RECUPERATION DU TOPIC
	$req=$bdd->prepare("SELECT id FROM TOPIC WHERE intitule=:intitule2");
	$req->bindParam(':intitule2',$topic);
	$req->execute();
	$res=$req->fetch();
	

	//AJOUT D'UN COMMENTAIRE
	$a = $bdd->prepare("INSERT INTO COMMENTAIRE(intitule, note_totale, date_ecriture, id_utilisateur, id_topic) VALUES (:intitule1,0,NOW(),:id_utilisateur1,:id_topic1)");
 	$a->bindParam(':intitule1',$commentaire);
    $a->bindParam(':id_utilisateur1', $user->getid());
    $a->bindParam(':id_topic1',$res['id']);
    $a->execute();

	header("Location: ../droit.php");




?>


