<?php
session_start();
require "../Models/bdd.php";

//SUPPRESSION DES COMMENTAIRES AVEC LES NOTES

	$a=$bdd->prepare('SELECT id FROM COMMENTAIRE WHERE id_topic=:id2');
	$a->bindParam(':id2', $_GET['topic']);
	$a->execute();

	while($note_com=$a->fetch())
	{
		$b=$bdd->prepare('DELETE FROM COMMENTAIRE_NOTE WHERE id_commentaire=:id2');
		$b->bindParam(':id2', $note_com['id']);
		$b->execute();
	}

	$c=$bdd->prepare('DELETE FROM COMMENTAIRE WHERE id_topic=:id2');
	$c->bindParam(':id2', $_GET['topic']);
	$c->execute();

//SUPPRESSION DU TOPIC AVEC LES NOTES

	$c=$bdd->prepare('DELETE FROM TOPIC_NOTE WHERE id_topic=:id2');	
	$c->bindParam(':id2', $_GET['topic']);
	$c->execute();


	$f=$bdd->prepare('DELETE FROM TOPIC WHERE id=:id2');	
	$f->bindParam(':id2', $_GET['topic']);
	$f->execute();

//Redirection vers un autre topic
	$g=$bdd->prepare('SELECT intitule FROM TOPIC');
	$g->execute();
	$h=$g->fetch();
	$_SESSION['test']=$h['intitule'];
	header("Location: ../droit.php");


	
?>